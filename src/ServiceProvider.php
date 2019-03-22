<?php
/**
 * Created by PhpStorm.
 * User: l57t7q
 * Date: 2017/12/21
 * Time: 15:15
 */

namespace Tianqi\Dingding;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot() {
        $this->publishes([
            __DIR__."/config.php" => config_path("dingding.php"),
        ], "config");
    }

    public function register() {
        $this->mergeConfigFrom(__DIR__."/config.php", "dingding");
        $this->app->bind(AliyunSms::class, function () {
            return new AliyunSms();
        });
    }

}