<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/7/10
 * Time: 5:51 PM
 */

namespace App\Sms\Adapters;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Client\Result\Result;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * 阿里云短息服务适配器
 * */
class AliyunAdapter implements SmsAdapterInterface
{
    protected $config = [];
    const PRODUCT = 'Dysmsapi';
    const VERSION = '2017-05-25';

    const SEND_SMS = 'SendSms';
    const QUERY_SMS_TEMPLATE = 'QuerySmsTemplate';
    const ADD_SMS_TEMPLATE = 'AddSmsTemplate';
    const DELETE_SMS_TEMPLATE = 'DeleteSmsTemplate';
    const MODIFY_SMS_TEMPLATE = 'ModifySmsTemplate';

    const PARAM_TAG = "/(?<=\$\{)([a-zA-Z]+[0-9]*)(?=\})/";

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function request(string $method, string $action, $options = [])
    {
        try {
            $this->initClient();
            return AlibabaCloud::rpc()
                ->product(self::PRODUCT)
                ->version(self::VERSION)
                ->action($action)
                ->method($method)
                ->options(['query' => $options])
                ->request();
        } catch (ClientException $e) {
//            dd($e);
            Log::debug($e->getMessage());
        } catch (ServerException $e) {
//            ($e->getMessage());
            Log::debug($e->getMessage());
        } catch (Exception $e) {
//            dd($e);
            Log::debug($e->getMessage());
        }
        return null;
    }

    /**
     * 发送短消息（阿里云短息）
     * @param string $mobile 手机号码
     * @param string $templateId
     * @param array $params 消息模版携带参数
     * @return Result|bool
     */
    public function sendSms(string $mobile, string $templateId, array $params)
    {
        try {
            $templateId = $this->config['templates'][$templateId] ?? $templateId;
            $result = $this->request('POST', self::SEND_SMS, [
                'RegionId' => $this->config['region_id'],
                'PhoneNumbers' => $mobile,
                'SignName' => $this->config['sign_name'],
                'TemplateCode' => $templateId,
                'TemplateParam' => json_encode($params),
            ]);
            return $result;
        } catch (Exception $e) {
        }
        return false;
    }

    /**
     * 初始化阿里巴巴云客户端
     * @throws
     * */
    protected function initClient()
    {
        AlibabaCloud::accessKeyClient($this->config['access_key'], $this->config['access_secret'])
            ->regionId($this->config['region_id'])
            ->asDefaultClient();
    }

    /**
     * 阿里云短息消息参数组装
     * @param string $mobile
     * @param string $templateId
     * @param array $params
     * @return array
     */
    protected function optionsBuilder(string $mobile, string $templateId, array $params)
    {
        $templateId = $this->config['templates'][$templateId] ?? $templateId;
        return [
            'query' => [
                'RegionId' => $this->config['region_id'],
                'PhoneNumbers' => $mobile,
                'SignName' => $this->config['sign_name'],
                'TemplateCode' => $templateId,
                'TemplateParam' => json_encode($params),
            ]
        ];
    }

    /**
     * 获取短信平台短信模版
     * @param string $templateId
     * @return array|null
     */
    public function queryTemplate(string $templateId)
    {
        $templateId = $this->config['templates'][$templateId] ?? $templateId;
        try {
            $result = $this->request('GET', self::QUERY_SMS_TEMPLATE, ['TemplateCode' => $templateId]);
            return $result->toArray();
        } catch (Exception $e) {
        }
        return null;
    }

    /**
     * 新建模版消息
     * @param int $type
     * @param string $name
     * @param string $content
     * @param string $remark
     * @return string
     */
    public function addTemplate(int $type, string $name, string $content, string $remark = '')
    {
        return $this->request('POST', self::ADD_SMS_TEMPLATE, [
            'TemplateType' => $type,
            'TemplateName' => $name,
            'TemplateContent' => $content,
            'Remark' => $remark
        ]);
    }

    /**
     * 更新短信模版
     * @param string $templateId
     * @param int $type
     * @param string $name
     * @param string $content
     * @param string $remark
     * @return boolean
     */
    public function updateTemplate(string $templateId, int $type, string $name, string $content, string $remark = '')
    {
        $templateId = $this->config['templates'][$templateId] ?? $templateId;
        return $this->request('POST', self::MODIFY_SMS_TEMPLATE, [
            'TemplateCode' => $templateId,
            'TemplateType' => $type,
            'TemplateName' => $name,
            'TemplateContent' => $content,
            'Remark' => $remark
        ]);
    }

    /**
     * 删除短信模版
     * @param string $templateId
     * @return boolean
     */
    public function deleteTemplate(string $templateId)
    {
        $templateId = $this->config['templates'][$templateId] ?? $templateId;
        return $this->request('GET', self::DELETE_SMS_TEMPLATE, [
            'TemplateCode' => $templateId
        ]);
    }
}
