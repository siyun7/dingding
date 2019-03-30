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

    private $_acceccToken;

    private $_params;

    public function __construct($config = null)
    {
        if ($config) {
            $this->_config = $config;
        } else {
            $this->_config = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php");
        }
    }

    public function getAccessToken()
    {
        $path = "/gettoken";
        $datas = [
            "appkey" => $this->_config["appkey"],
            "appsecret" => $this->_config["appsecret"]
        ];
        $resp = Http::get($path, $datas);

        if ($resp->errcode == 0) {
            $this->_acceccToken = $resp->access_token;
            $this->_config["access_token"] = $resp->access_token;
        }

        return $resp;
    }

    public function getProcessListIds($params)
    {
        $path = "/topapi/processinstance/listids";
        $datas = [
            "process_code" => $params["processCode"],
            "start_time" => $params["startTime"],
        ];
        $resp = Http::post($path, $this->_params, $datas);
        return $resp;

    }

    public function getProcess($params)
    {
        $path = "/topapi/processinstance/get";
        $datas = [
            "process_code" => $params["processCode"],
            "start_time" => $params["startTime"],
        ];
        $resp = Http::post($path, $this->_params, $datas);
        return $resp;
    }

    public function createPeocess($params)
    {
        $path = "/topapi/processinstance/create";
        Http::post($path, $this->_params, $params);
    }

    public function getUserInfo($params)
    {
        $path = "/user/getuserinfo";
        $data = [
            "access_token" => $this->_acceccToken,
            "code" => $params["authCode"]
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    public function getUser($params)
    {
        $path = "/user/get";
        $data = [
            "access_token" => $this->_acceccToken,
            "code" => $params["authCode"]
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }


}