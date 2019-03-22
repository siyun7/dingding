<?php
/**
 * Created by PhpStorm.
 * User: Tianqi
 * Date: 2019/3/22
 * Time: 16:06
 */

namespace Tianqi\Dingding\Core\Regions;


class EndpointProvider
{
    private static $endpoints;

    public static function getEndpoints()
    {
        return self::$endpoints;
    }

    public static function setEndpoints($endpoints)
    {
        self::$endpoints = $endpoints;
    }
}