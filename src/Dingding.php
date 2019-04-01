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
            $this->_params["access_token"] = $resp->access_token;
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
            "process_instance_id" => $params["processId"],
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

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:21
     * 获取部门用户userid列表
     * @param $params
     * @return mixed
     */
    public function getDeptMember($params)
    {
        $path = "/user/get";
        $data = [
            "access_token" => $this->_acceccToken,
            "deptId" => $params["deptId"]
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }


    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:23
     * 获取部门用户
     * @param $params
     * @return mixed
     */
    public function getSimplelist($params)
    {
        $path = "/user/simplelist";
        $data = [
            "access_token" => $this->_acceccToken,
            "department_id" => $params["deptId"],
            "lang" => $params["lang"],
            "offset" => $params["offset"],
            "size" => $params["size"],
            "order" => $params["order"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:23
     * 获取部门用户详情
     * @param $params
     * @return mixed
     */
    public function getListbypage($params)
    {
        $path = "/user/listbypage";
        $data = [
            "access_token" => $this->_acceccToken,
            "department_id" => $params["deptId"],
            "lang" => $params["lang"],
            "offset" => $params["offset"],
            "size" => $params["size"],
            "order" => $params["order"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:24
     * 获取管理员列表
     * @return mixed
     */
    public function getAdmin()
    {
        $path = "/user/get_admin";
        $data = [
            "access_token" => $this->_acceccToken
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:25
     * 获取管理员通讯录权限范围
     * @param $params
     * @return mixed
     */
    public function getAdminScope($params)
    {
        $path = "/user/get_admin";
        $data = [
            "access_token" => $this->_acceccToken,
            "userid" => $params["userId"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:25
     * 根据unionid获取userid
     * @param $params
     * @return mixed
     */
    public function getUseridByUnionid($params)
    {
        $path = "/user/get_admin";
        $data = [
            "access_token" => $this->_acceccToken,
            "unionid" => $params["unionId"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:28
     * 创建用户
     * @param $params
     * @return mixed
     */
    public function createUser($params)
    {
        $path = "/user/create";
        $data = [
            "userid" => $params["userID"],
            "name" => $params["name"],
            "orderInDepts" => $params["orderInDepts"],
            "department" => $params["department"],
            "position" => $params["position"],
            "mobile" => $params["mobile"],
            "tel" => $params["tel"],
            "workPlace" => $params["workPlace"],
            "remark" => $params["remark"],
            "email" => $params["email"],
            "orgEmail" => $params["orgEmail"],
            "jobnumber" => $params["jobnumber"],
            "isHide" => $params["isHide"],
            "isSenior" => $params["isSenior"],
        ];
        $resp = Http::post($path, $this->_params, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:29
     * 更新用户
     * @param $params
     * @return mixed
     */
    public function updateUser($params)
    {
        $path = "/user/create";
        $data = [
            "userid" => $params["userID"],
            "name" => $params["name"],
            "orderInDepts" => $params["orderInDepts"],
            "department" => $params["department"],
            "position" => $params["position"],
            "mobile" => $params["mobile"],
            "tel" => $params["tel"],
            "workPlace" => $params["workPlace"],
            "remark" => $params["remark"],
            "email" => $params["email"],
            "orgEmail" => $params["orgEmail"],
            "jobnumber" => $params["jobnumber"],
            "isHide" => $params["isHide"],
            "isSenior" => $params["isSenior"],
        ];
        $resp = Http::post($path, $this->_params, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:30
     * 删除用户
     * @param $params
     * @return mixed
     */
    public function deleteUser($params)
    {
        $path = "/user/create";
        $data = [
            "access_token" => $this->_acceccToken,
            "userid" => $params["userID"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:33
     * 获取子部门ID列表
     * @param $params
     * @return mixed
     */
    public function getDeptListIds($params)
    {
        $path = "/department/list_ids";
        $data = [
            "access_token" => $this->_acceccToken,
            "id" => $params["id"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:34
     * 获取部门列表
     * @param $params
     * @return mixed
     */
    public function getDeptList($params)
    {
        $path = "/department/list";
        if (!isset($params["fetch_child"]) || !$params["fetch_child"]) $params["fetch_child"] = false;
        $data = [
            "access_token" => $this->_acceccToken,
            "id" => $params["id"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:35
     * 获取部门详情
     * @param $params
     * @return mixed
     */
    public function getDept($params)
    {
        $path = "/department/list";
        if (!isset($params["fetch_child"]) || !$params["fetch_child"]) $params["fetch_child"] = false;
        $data = [
            "access_token" => $this->_acceccToken,
            "id" => $params["id"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:37
     * 查询部门的所有上级父部门路径
     * @param $params
     * @return mixed
     */
    public function listParentDeptsByDept($params)
    {
        $path = "/department/list_parent_depts_by_dept";
        $data = [
            "access_token" => $this->_acceccToken,
            "id" => $params["id"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:37
     * 查询指定用户的所有上级父部门路径
     * @param $params
     * @return mixed
     */
    public function listParentDepts($params)
    {
        $path = "/department/list_parent_depts";
        $data = [
            "access_token" => $this->_acceccToken,
            "userId" => $params["userId"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:38
     * 获取企业员工人数
     * @param $params
     * @return mixed
     */
    public function getOrgUserCount($params)
    {
        $path = "/user/get_org_user_count";
        $data = [
            "access_token" => $this->_acceccToken,
            "onlyActive" => $params["onlyActive"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:40
     * 创建部门
     * @param $params
     * @return mixed
     */
    public function createDepartment($params)
    {
        $path = "/department/create";
        $data = [
            "name" => $params["name"],
            "parentid" => $params["parentid"],
            "order" => $params["order"],
            "createDeptGroup" => $params["createDeptGroup"],
            "deptHiding" => $params["deptHiding"],
            "deptPermits" => $params["deptPermits"],
            "userPermits" => $params["userPermits"],
            "outerDept" => $params["outerDept"],
            "outerPermitDepts" => $params["outerPermitDepts"],
            "outerPermitUsers" => $params["outerPermitUsers"],
            "sourceIdentifier" => $params["sourceIdentifier"],
        ];
        $resp = Http::post($path, $this->_params, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:41
     * 更新部门
     * @param $params
     * @return mixed
     */
    public function updateDepartment($params)
    {
        $path = "/department/update";
        $data = [
            "name" => $params["name"],
            "parentid" => $params["parentid"],
            "order" => $params["order"],
            "createDeptGroup" => $params["createDeptGroup"],
            "deptHiding" => $params["deptHiding"],
            "deptPermits" => $params["deptPermits"],
            "userPermits" => $params["userPermits"],
            "outerDept" => $params["outerDept"],
            "outerPermitDepts" => $params["outerPermitDepts"],
            "outerPermitUsers" => $params["outerPermitUsers"],
            "sourceIdentifier" => $params["sourceIdentifier"],
        ];
        $resp = Http::post($path, $this->_params, $data);

        return $resp;
    }

    /**
     * User: Tianqi
     * Date: 2019/4/1
     * Time: 13:42
     * 删除部门
     * @param $params
     * @return mixed
     */
    public function deleteDepartment($params)
    {
        $path = "/department/delete";
        $data = [
            "access_token" => $this->_acceccToken,
            "id" => $params["id"],
        ];
        $resp = Http::get($path, $data);

        return $resp;
    }

}