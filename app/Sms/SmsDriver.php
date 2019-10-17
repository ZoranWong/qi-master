<?php
/**
 * Created by PhpStorm.
 * User: wangzaron
 * Date: 2019/8/15
 * Time: 11:18 AM
 */

namespace App\Sms;


class SmsDriver
{
    protected $driverName = null;
    protected $adapter = null;
    protected $config = null;

    public function __construct(string $driver, string $adapter, array $config = [])
    {
        $this->config = $config;
        $this->adapter = $adapter;
        $this->driverName = $driver;
    }

    public function getClient()
    {
        return new $this->adapter($this->config);
    }

    public function getDriver()
    {
        return $this->driverName;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
        $method = "get".ucfirst($name);
        return $this->{$method}();
    }
}
