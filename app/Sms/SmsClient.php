<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/7/10
 * Time: 5:39 PM
 */

namespace App\Sms;


use App\Jobs\Sms\SendSms;
use App\Sms\Adapters\SmsAdapterInterface;
use Exception;
use Illuminate\Support\Str;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * 短信服务
 * @property-read SmsAdapterInterface $client
 * @property-read string $driverName
 * @property-read array $config
 * @method string addTemplate(int $type, string $name, string $content, string $remark)
 * */
class SmsClient
{
    protected $driver = null;

    public function __construct(SmsDriver $driver)
    {
        $this->driver = $driver;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        return $this->driver->$name;
    }

    /**
     *短信发送接口
     * @param string $mobile 手机号码
     * @param string $templateId 模版ID
     * @param array $params 模版参数
     * @return mixed
     */
    public function sendSms(string $mobile, string $templateId, array $params)
    {
//        dispatch(new SendSms($this->client, $mobile, $templateId, $params));
        return $this->client->sendSms($mobile, $templateId, $params);
    }

    /**
     *验证码发送接口
     * @param string $mobile 手机号码
     * @param string $template 验证码模版名称
     * @param string $cacheKey 缓存key
     * @param int $expires 缓存过期时间（分钟）
     * @param int $codeLength 验证码长度
     * @param bool $includeChar 是否含有字母
     */
    public function sendCaptcha(string $mobile, string $template, string $cacheKey, int $expires = 3600, int $codeLength = 6, bool $includeChar = false)
    {
        mt_srand(time());
        $min = pow(10, $codeLength - 1);
        $max = pow(10, $codeLength);

        $code = $includeChar ? Str::random($codeLength) : mt_rand($min, $max);

        try {
            cache()->set($cacheKey, $code, $expires);

            $this->sendSms($mobile, $template, [
                'code' => $code
            ]);
        } catch (Exception $e) {

        } catch (InvalidArgumentException $e) {

        }
    }

    public function __call($name, $args)
    {
        if (method_exists($this->client, $name)) {
            return call_user_func_array([$this->client, $name], $args);
        }
    }
}
