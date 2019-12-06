<?php

namespace Illuminate\Notifications;

use SmsTraffic\Client as SmsTrafficClient;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;

class SmsTrafficChannelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('smstraffic', function ($app) {
                return new Channels\SmsTrafficSmsChannel(
                    new SmsTrafficClient(
                        $this->app['config']['services.smstraffic.login'],
                        $this->app['config']['services.smstraffic.password'],
                        $this->app['config']['services.smstraffic.url'],
                        $this->app['config']['services.smstraffic.failover_url']
                    ),
                    $this->app['config']['services.smstraffic.sms_from']
                );
            });
        });
    }
}
