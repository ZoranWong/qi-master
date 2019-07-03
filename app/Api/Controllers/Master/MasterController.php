<?php

namespace App\Api\Controllers\Master;

use App\Api\Controller;
use App\Http\Requests\MasterServiceUpdateRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Models\Master;
use App\Models\MasterService;
use App\Models\ServiceType;
use App\Repositories\MasterRepository;
use App\Transformers\MasterTransformer;
use Dingo\Api\Http\Response;
use Illuminate\Http\JsonResponse;

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
        $data = $request->only(['services', 'key_areas', 'other_areas', 'work_day', 'work_time', 'team_nums', 'truck_nums', 'truck_type', 'truck_tonnage']);

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
}
