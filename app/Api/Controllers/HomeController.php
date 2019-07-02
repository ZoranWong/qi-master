<?php

namespace App\Api\Controllers;

use App\Api\Controller;
use App\Models\Classification;
use App\Models\Region;
use App\Models\ServiceType;
use App\Transformers\ClassificationTransformer;
use App\Transformers\RegionTransformer;
use App\Transformers\ServiceTypeTransformer;
use Dingo\Api\Http\Response;

class HomeController extends Controller
{
    /**
     * 服务类目列表
     * @return Response
     */
    public function classifications()
    {
        $classifications = Classification::query()->active()->get();

        return $this->response->collection($classifications, new ClassificationTransformer);
    }

    /**
     * 服务类型列表
     * @return Response
     */
    public function serviceTypes()
    {
        $serviceTypes = ServiceType::all();

        return $this->response->collection($serviceTypes, new ServiceTypeTransformer);
    }

    /**
     * 区域代码
     */
    public function regions()
    {
        $levelList = Region::getProvinces();

        return $this->response->collection($levelList, new RegionTransformer);
    }
}
