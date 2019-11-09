<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Api\Requests\Master\BankAccountRequest;
use App\Api\Requests\Master\DrawDepositRequest;
use App\Http\Requests\MasterServiceUpdateRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Models\Master;
use App\Models\MasterBank;
use App\Models\MasterService;
use App\Models\ServiceType;
use App\Models\WithdrawDepositOrder;
use App\Repositories\MasterRepository;
use App\Transformers\Api\Master\DrawDepositTransformer;
use App\Transformers\Master\BankTransformerTransformer;
use App\Transformers\MasterTransformer;
use Dingo\Api\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class MasterController extends Controller
{
    protected $repository;

    public function __construct(MasterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function profile()
    {
        $master = $this->repository->getMasterInfo();

        return $this->response->item($master, new MasterTransformer);
    }

    /**
     * 修改登录密码
     * @param UserUpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(UserUpdatePasswordRequest $request)
    {
        $data = $request->only(['old_password', 'password']);

        /** @var Master $master */
        $master = auth()->user();

        if (!password_verify($data['old_password'], $master->password)) {
            $this->response->errorBadRequest('原密码错误');
        }

        if (password_verify($data['password'], $master->password)) {
            $this->response->errorBadRequest('新密码不能和原密码一样');
        }

        $master->update(['password' => bcrypt($data['password'])]);

        auth()->logout();

        return response()->json(['message' => '密码修改成功', 'status_code' => 200]);
    }

    /**
     * 修改钱包密码
     * @param UserUpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function changeWalletPassword(UserUpdatePasswordRequest $request)
    {
        $data = $request->only(['password', 'old_password']);

        /** @var Master $master */
        $master = auth()->user();

        if ($data['password'] === $data['old_password']) {
            $this->response->errorBadRequest('新钱包密码不可与原钱包密码一样');
        }

        if (!password_verify($data['old_password'], $master->walletPassword)) {
            $this->response->errorBadRequest('原钱包密码错误');
        }

        $master->update(['wallet_password' => bcrypt($data['password'])]);

        return response()->json([
            'message' => '钱包密码已修改', 'status_code' => 200
        ]);
    }

    /**
     * 设置钱包密码
     * @param UserUpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function setWalletPassword(UserUpdatePasswordRequest $request)
    {
        $walletPassword = $request->input('password');

        /** @var Master $master */
        $master = auth()->user();

        $firstSet = $master->walletPassword ? true : false;

        $master->update(['wallet_password' => bcrypt($walletPassword)]);

        $message = $firstSet ? '钱包密码设置成功' : '钱包密码已设置';

        return response()->json([
            'message' => $message
        ]);
    }

    /**
     * 设置服务信息
     * @param MasterServiceUpdateRequest $request
     * @return Response
     */
    public function updateServiceInfo(MasterServiceUpdateRequest $request)
    {
        $data = $request->only(['services', 'key_areas', 'other_areas', 'work_day',
            'work_time', 'team_nums', 'truck_nums', 'truck_type', 'truck_tonnage']);

        /** @var Master $master */
        $master = auth()->user();

        $keyAreas = $data['key_areas'];
        $otherAreas = $data['other_areas'];

        $serviceAreas = [];
        foreach ($keyAreas as $keyArea) {
            $serviceAreas[] = ['region_code' => $keyArea, 'type' => MasterService::TYPE_KEY, 'weight' => MasterService::WEIGHT_KEY];
        }
        foreach ($otherAreas as $otherArea) {
            $serviceAreas[] = ['region_code' => $otherArea, 'type' => MasterService::TYPE_OTHER, 'weight' => MasterService::WEIGHT_OTHER];
        }

        // 更新服务区域
        $master->serviceAreas()->where('type', '<>', MasterService::TYPE_CORE)->delete();
        $master->serviceAreas()->createMany($serviceAreas);
        // 更新服务类目类型
        $master->services()->delete();
        $services = $data['services'];
        foreach ($services as &$service) {
            $serviceTypes = ServiceType::whereIn('id', $service['services'])->get();
            $service['services'] = [];
            foreach ($serviceTypes as $serviceType) {
                $service['services'][] = ['id' => $serviceType->id, 'name' => $serviceType->name];
            }
        }

        $master->services()->createMany($services);
        // 更新其他服务信息
        $master->update($data);

        return $this->response->noContent();
    }

    public function getOrderStatistics()
    {
        $master = $this->repository->getOrderStatistics();

        return response()->json([
            'data' => [
                'order_wait_agree_count' => $master->order_wait_agree_count,
                'order_wait_pay_count' => $master->order_wait_pay_count,
                'order_wait_pre_appoint_count' => $master->order_wait_pre_appoint_count,
                'order_wait_sign_count' => $master->order_wait_sign_count,
                'order_signed_count' => $master->order_signed_count,
                'order_wait_check_count' => $master->order_wait_check_count,
                'order_completed_count' => $master->order_completed_count,
                'order_closed_count' => $master->order_closed_count
            ]
        ]);
    }

    public function drawDeposit(DrawDepositRequest $request)
    {
        /**@var Master $master */
        $master = auth()->user();
        $order = new WithdrawDepositOrder();
        $order->applyAmount = $request->input('apply_amount');
        $order->status = WithdrawDepositOrder::HANDLING;
        if($master->withdrawOrders()->whereIn('status', [WithdrawDepositOrder::HANDLING, WithdrawDepositOrder::AGREE_WITHDRAW])
                ->where('created_at', '>=', Carbon::now()->startOfMonth())
            ->where('created_at', '<', Carbon::now()->endOfMonth())->count() > config('withdraw.free_time')) {
            $order->commission = $order->applyAmount * config('withdraw.commission_rate');
        }
        $master->withdrawOrders()->save($order);
        return $this->response->array([
            'message' => 'OK',
            'code' => 'SUCCESS'
        ]);
    }

    public function drawDeposits()
    {
        /**@var Master $master */
        $master = auth()->user();
        $query = $master->withdrawOrders();
        if (request('status', null)) {
            $query->where('status', request('status'));
        }
        $data = $query->paginate(request('limit', PAGE_SIZE));

        return $this->response->paginator($data, new DrawDepositTransformer);
    }


    public function addBankAccount(BankAccountRequest $request)
    {
        /**@var Master $master */
        $master = auth()->user();
        $bank = new MasterBank();
        $bank->bankAccountCode = $request->input('bank_account_code');
        $bank->accountOpenBank = $request->input('account_open_bank');
        $bank = $master->bankAccounts()->save($bank);
        if (!$bank) {
            $this->response->errorInternal('失败');
        }
        return $this->response->noContent();
    }


    public function updateBankAccount(MasterBank $bank, BankAccountRequest $request)
    {
        $bank->bankAccountCode = $request->input('bank_account_code');
        $bank->accountOpenBank = $request->input('account_open_bank');
        $bank = $bank->save();
        if (!$bank) {
            $this->response->errorInternal('失败！');
        }
        return $this->response->noContent();
    }

    public function deleteBankAccount(MasterBank $bank)
    {
        try {
            if ($bank->delete()) {
                return $this->response->noContent();
            } else {
                $this->response->errorInternal('失败！');
            }
        } catch (\Exception $e) {
            $this->response->errorInternal('失败！');
        }
    }

    public function getBankInfo()
    {
        /**@var Master $master */
        $master = auth()->user();
        if ($master->bankAccounts->count())
            return $this->response->item($master->bankAccounts->first(), new BankTransformerTransformer());
        throw new ModelNotFoundException('没有银行卡');
    }
}
