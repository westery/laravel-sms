<?php

namespace Westery\LaravelSms;
use Illuminate\Support\ServiceProvider;

/**
 * 短信ServiceProvider
 * Class SmsServiceProvider
 * @package Westery\LaravelSms
 */
class SmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'./config/sms.php' => config_path('sms.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'./config/sms.php', 'sms'
        );
        $this->app->singleton('Sms', function ($app) {
            $app = new Sms(config('sms.default'));
            return $app;
        });
    }
}
