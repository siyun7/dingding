<?php
/**
 * Created by PhpStorm.
 * User: Tianqi
 * Date: 2019/3/22
 * Time: 16:03
 */

namespace Tianqi\Dingding\Core\Regions;


class EndpointConfig
{
    private static $loaded = false;

    public static function load() {
        if (self::$loaded) return;
        $endpoint_filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . "Endpoints.php";
        $endpoints = include_once($endpoint_filename);
        EndpointProvider::setEndpoints($endpoints);
        self::$loaded = true;

    }
}