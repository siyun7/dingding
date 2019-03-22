<?php
/**
 * Created by PhpStorm.
 * User: Tianqi
 * Date: 2019/03/22
 * Time: 15:56
 */

namespace L57t7q\AliyunSmsSdk;


class Autoload
{

    public static function config() {
        if (!defined("DINGDING_PATH")) {
            define("DINGDING_PATH", dirname(__FILE__) . '/');
        }
        include (DINGDING_PATH."Config.php");
    }
}