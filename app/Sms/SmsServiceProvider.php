<?php

namespace App\Sms;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sms', function () {
            $driverName = config('sms.default');
            $class = config("sms.drivers.{$driverName}");
            $config = null;
            if (is_array($class)) {
                $config = $class['config'];
                $class = $class['adapter'];
            }
            $driver = new SmsDriver($driverName, $class, $config);
            return new SmsClient($driver);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        try {
//            $sms = $this->app->make('sms');
//            /**
//             * @var Collection|SmsEvent[] $smsEvents
//             * */
//            $smsEvents = app(SmsEventRepository::class)->findWhere([
//                'sms_driver' => $sms->driverName
//            ]);
//
//            $smsEvents->map(function (SmsEvent $event) {
//                Event::listen($event->eventClass, SmsSendListener::class);
//            });
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }
    }
}
