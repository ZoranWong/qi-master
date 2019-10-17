#### SMS短息服务客户端。兼容多个平台只需实现SmsAdapterInterface接口即可
- 配置文件sms.php
    - default :默认服务驱动
    - drivers: 第三方短息服务驱动列表
        
        - name: 名称
        - adapter: 驱动适配器 SmsAdapterInterface实现
        - config: 各个三方短信服务平台具体配置
        
- 使用Laravel在app.php 配置文件中加入 \App\Sms\SmsServiceProvider::class到providers中注册服务。
- 然后可以直接使用app('sms'）直接调用SmsAdapterInterface接口方法完成短息发送与模版操作。
- 发送普通短信 app('sms')->sendSms($mobile, $templateId, $params); (进入队列异步发送)
- 发送验证码 app('sms')->sendCaptcha(string $mobile, string $template, string $cacheKey, int $expires = 3600, int $codeLength = 6, bool $includeChar = false)(进入队列异步发送)


* 备注：

  
```php
/**
 * 平台短息服务统一入口（短信发送客户端适配器）
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
    function send(string $mobile, string $templateId, array $params);


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
```


