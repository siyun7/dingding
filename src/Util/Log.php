<?php
/**
 * Created by PhpStorm.
 * User: Tianqi
 * Date: 2019/3/22
 * Time: 16:44
 */

namespace Tianqi\Dingding\Util;


class Log
{
    public static function i($msg)
    {
        self::write('I', $msg);
    }

    public static function e($msg)
    {
        self::write('E', $msg);
    }

    private static function write($level, $msg)
    {
        $filename = DINGDING_PATH . "server.log";
        $logFile = fopen($filename, "aw");
        fwrite($logFile, $level . "/" . date(" Y-m-d h:i:s") . "  " . $msg . "\n");
        fclose($logFile);
    }

}