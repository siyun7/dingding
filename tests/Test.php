<?php
/**
 * Created by PhpStorm.
 * User: Tianqi
 * Date: 2019/3/28
 * Time: 11:25
 */


use Tianqi\Dingding\Dingding;

class Test
{
    private $_config = ["appkey" => "dingq5j7krfv3pwox8f3", "appsecret" => "eIWhMUlken32lC2GRV9e6iDlxQezNMO_UXJT-2wIMZ-fa5RJBmUi0GAiX4YFMEdI"];

    public function start(...$params) {
        try {

            $dingding = new Dingding($this->_config);
            $resp = $dingding->getAccessToken();

            $params = [
                "processCode" => "PROC-0KYJJ30V-Q5Y3VUQO3FACB59NDHJD2-OZTXHITJ-02",
                "startTime" => 1544406815
            ];
            $resp = $dingding->getProcessListIds($params);

            $params = ["processId" => "c5a04491-e70c-4ec0-bcc9-9986f91b5719"];
            $resp = $dingding->getProcess($params);
        } catch (\Throwable $e) {
            var_dump($e);
        }
//        Log::info($accessToken);
        var_dump($resp);
    }
}