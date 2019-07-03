<?php

namespace App\Api\Controllers;

use App\Api\Controller;
use App\Models\Classification;
use App\Models\ComplaintType;
use App\Models\Region;
use App\Transformers\ClassificationTransformer;
use App\Transformers\ComplaintTypeTransformer;
use App\Transformers\RegionTransformer;
use App\Transformers\ServiceTypeTransformer;
use Dingo\Api\Http\Request;
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
     * @param Request $request
     * @return Response
     */
    public function serviceTypes(Request $request)
    {
        if (!$request->has('classification_id')) {
            $this->response->errorBadRequest('缺少classification_id参数');
        }

        /** @var Classification $classification */
        $classification = Classification::whereKey($request->input('classification_id'))->first();

        if (is_null($classification)) {
            $this->response->errorNotFound('没有找到类目');
        }

        $serviceTypes = $classification->serviceTypes;

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

    /**
     * 投诉类型
     */
    public function complaintTypes()
    {
        $complaintTypes = ComplaintType::topLevel()->with(['children'])->get(['id', 'name']);

        return $this->response->collection($complaintTypes, new ComplaintTypeTransformer);
    }
}
