<?php
/**
 * Created by PhpStorm.
 * User: Tianqi
 * Date: 2019/03/22
 * Time: 16:20
 */
namespace Tianqi\Dingding;

use Tianqi\Dingding\Core\Config;
use Tianqi\Dingding\Util\Http;
use Tianqi\Dingding\Util\Log;

// 加载API列表
Config::load();


class Dingding
{
    private $_config;

    public function __construct($config = null)
    {
        if ($config) {
            $this->_config = $config;
        } else {
            $this->_config = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php");
        }
    }

    public static function getAccessToken($appkey, $appsecret)
    {
        $resp = Http::get("/gettoken",
            array(
                "appkey" => $appkey,
                "appsecret" => $appsecret,
            ));
        if ($resp->errcode != 0) {
            Log::e('获取access_token错误，' . $resp->errmsg);
            return "";
        }

        return $resp->access_token;
    }

}