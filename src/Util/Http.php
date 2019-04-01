<?php
/**
 * Created by PhpStorm.
 * User: Tianqi
 * Date: 2019/3/22
 * Time: 16:32
 */

namespace Tianqi\Dingding\Util;


use Httpful\Request as Request;

class Http
{
    public static function get($path, $params)
    {
        $url = self::joinParams($path, $params);
        $resp = Request::get($url)->send();
        if ($resp->hasErrors())
        {
            var_dump($resp);
        }
        if ($resp->body->errcode != 0)
        {
            var_dump($resp->body);
        }
        return $resp->body;
    }

    public static function post($path, $params, $data) {
        $url = self::joinParams($path, $params);
        $url = rtrim($url,"&");
        $resp = Request::post($url)
            ->body($data)
            ->sendsJson()
            ->send();

        if ($resp->hasErrors())
        {
            var_dump($resp);
        }
        if ($resp->body->errcode != 0)
        {
            var_dump($resp->body);
        }
        return $resp->body;
    }

    private static function joinParams($path, $params)
    {
        $url = OAPI_HOST . $path;
        if (count($params) > 0)
        {
            $url = $url . "?";
            foreach ($params as $key => $value)
            {
                $url = $url . $key . "=" . $value . "&";
            }
            $length = strlen($url);
            if ($url[$length - 1] == '&')
            {
                $url = substr($url, 0, $length - 1);
            }
        }
        return $url;
    }
}