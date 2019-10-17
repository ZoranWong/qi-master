<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/7/10
 * Time: 5:46 PM
 */

namespace App\Sms\Adapters;

/**
 * 平台短信服务统一入口（短信发送客户端适配器）
 * */
interface SmsAdapterInterface
{
    /**
     * 发送短消息
     * @param string $mobile 手机号码
     * @param string $templateId 消息模版
     * @param array $params 消息模版携带参数
     * @return mixed
     */
    function sendSms(string $mobile, string $templateId, array $params);


    /**
     * 获取短信平台短信模版
     * @param string $templateId
     * @return array
     */
    function queryTemplate(string $templateId);

    /**
     * 新建模版消息
     * @param int $type
     * @param string $name
     * @param string $content
     * @param string $remark
     * @return string
     */
    function addTemplate(int $type, string $name, string $content, string $remark);

    /**
     * 更新短信模版
     * @param string $templateId
     * @param int $type
     * @param string $name
     * @param string $content
     * @param string $remark
     * @return boolean
     */
    function updateTemplate(string  $templateId, int $type, string $name, string $content, string $remark = '');

    /**
     * 删除短信模版
     * @param string $templateId
     * @return boolean
     */
    function deleteTemplate(string $templateId);
}
