<?php

namespace App\Api\Controllers;

use App\Api\Controller;
use App\Http\Requests\MasterCreateRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Master;
use App\Models\MasterService;
use App\Models\User;
use App\Repositories\MasterRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\Inflector\Inflector;

class AuthController extends Controller
{
    /**
     * @param UserUpdateRequest $request
     * @return JsonResponse
     */
    public function login(UserUpdateRequest $request)
    {
        $credential = $request->only(['mobile', 'password']);

        /** @var User|Master $user */
        $guard = config('auth.defaults.guard');
        $provider = config("auth.guards.{$guard}.provider");
        if (config("auth.guards.{$guard}.driver") === 'jwt') {
            $userClass = config("auth.providers.{$provider}.model");
            $user = new $userClass;
            $customClaims = $user->getJWTCustomClaims();
            auth()->claims($customClaims);
        }

        if (!($token = auth()->attempt($credential))) {
            $this->response->errorUnauthorized('账号密码不匹配');
        }

        if (is_bool($token) && $token) {
            return response()->json(['message' => 'Successfully logged in']);
        }

        return $this->responseWithToken($token);
    }

    public function register(UserCreateRequest $request)
    {
        $credential = $request->only('mobile', 'password');

        $guard = ucfirst(Inflector::singularize(config('auth.defaults.guard')));

        $memberRepository = app("App\\Repositories\\{$guard}Repository");

        if (count($memberRepository->findWhere(['mobile' => $credential['mobile']]))) {
            $this->response->errorForbidden('手机号已注册，不可重复注册');
        }

        /** @var User|Master $user */
        $memberRepository->create([
            'mobile' => $credential['mobile'],
            'password' => bcrypt($credential['password']),
            'name' => $credential['mobile'],
            'avatar' => getImageUrl(null)
        ]);

        $token = auth()->attempt($credential);

        if (is_bool($token) && $token) {
            return response()->json([
                'message' => 'Successfully registered'
            ]);
        }

        return $this->responseWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    protected function responseWithToken($token)
    {
        return response()->json([
            'user' => auth()->user(),
            'token' => 'bearer ' . $token
        ]);
    }

    /**
     * 免费入驻
     * @param MasterCreateRequest $request
     */
    public function freeSettle(MasterCreateRequest $request, MasterRepository $masterRepository)
    {
        $data = $request->only([
            'mobile', 'captcha', 'password', 'emergency_mobile', 'province_code', 'city_code', 'area_code', 'address',
            'services', 'key_areas', 'other_areas'
        ]);

        // TODO 验证码验证

        if (count($masterRepository->findWhere(['mobile' => $data['mobile']]))) {
            $this->response->errorForbidden('手机号已注册，不可重复注册');
        }

        $plainPassword = $data['password'];
        $data['password'] = bcrypt($data['password']);

        $keyAreas = $data['key_areas'];
        $otherAreas = $data['other_areas'];

        $serviceAreas = [];
        foreach ($keyAreas as $keyArea) {
            $serviceAreas[] = ['region_code' => $keyArea, 'type' => MasterService::TYPE_KEY, 'weight' => MasterService::WEIGHT_KEY];
        }
        foreach ($otherAreas as $otherArea) {
            $serviceAreas[] = ['region_code' => $otherArea, 'type' => MasterService::TYPE_OTHER, 'weight' => MasterService::WEIGHT_OTHER];
        }

        /** @var Master $master */
        $master = $masterRepository->create($data);

        $master->services()->createMany($data['services']);

        $serviceAreas[] = ['region_code' => $master->areaCode, 'type' => MasterService::TYPE_CORE, 'weight' => MasterService::WEIGHT_CORE];
        $master->serviceAreas()->createMany($serviceAreas);

        // 设置模型提供器
        auth()->getProvider()->setModel(Master::class);
        $token = auth()->attempt(['mobile' => $data['mobile'], 'password' => $plainPassword]);

        return $this->responseWithToken($token);
    }
}
