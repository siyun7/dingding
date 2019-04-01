
钉钉企业内部开发工具包
=======

### 下载安装

* composer安装:

```shell
composer require tianqi/dingding
```

### 使用

   强烈建议通读钉钉企业开发最新官方文档，注意是最新版，与钉钉技术沟通过
   目前能看到老版本的接口文档地址。
   最细接口文档地址：
   [https://open-doc.dingtalk.com/microapp/serverapi2/gh60vz](https://open-doc.dingtalk.com/microapp/serverapi2/gh60vz)

　　针对Laravel做了单独优化，其他任何支持composer的均可使用;
   其中$configs格式约定为：
   ```php
   $configs = [
        "appsecret" => "appsecret",
        "appkey" => "appkey"
    ];
   ```
   $dingding = new Dingding($configs);

### 方法列表

#### 获取access_token
     $dingding->getAccessToken();

#### 获取审批列表

     $params = ["processCode" => "processCode", "startTime" => time()];
     $dingding->getProcessListIds($params);

#### 获取进度详情

     $params = ["processId" => "processId"];
     $dingding->getProcess($params);     
 
#### 发起审批
     $params 参数请参照官方手册
     [https://open-doc.dingtalk.com/microapp/serverapi2/cmct1a](https://open-doc.dingtalk.com/microapp/serverapi2/cmct1a)
     其中接口发起审批只支持单行输入，多行输入，图片，明细，其他类型会报错，
     详情可参考官方钉钉审批接入必读文档[https://open-doc.dingtalk.com/microapp/serverapi2/ca8r99](https://open-doc.dingtalk.com/microapp/serverapi2/ca8r99)
        
     $dingding->createPeocess($params);
     
#### 获取用户信息

     $params = ["authCode" => "authCode"];
     $dingding->getUserInfo($params);
     
#### 获取用户详情

     $params = ["authCode" => "authCode"];
     $dingding->getUser($params);     
     
#### 获取管理员列表

     $dingding->getAdmin();       
     
#### 获取管理员通讯录权限范围

     $params = ["userId" => "userId"];
     $dingding->getAdminScope($params);          
      
#### 获取用户详情

     $params = ["authCode" => "authCode"];
     $dingding->getUser($params);     

#### 根据unionid获取userid

     $params = ["unionid" => "unionid"];
     $dingding->getUseridByUnionid($params);     

#### 创建用户

     $dingding->createUser($params);          
      
#### 更新用户

     $dingding->updateUser($params);     

#### 获取用户详情

     $params = ["authCode" => "authCode"];
     $dingding->getUser($params);                 
                
#### 删除用户

     $params = ["userid" => "userid"];
     $dingding->deleteUser($params);          
      
#### 获取子部门ID列表

     $params = ["id" => "id"];
     $dingding->getDeptListIds($params);     

#### 获取部门列表

     $params = ["id" => "id"];
     $dingding->getDeptList($params);                 
 
#### 获取部门详情

     $params = ["getDept" => "getDept"];
     $dingding->getDept($params);          
      
#### 查询部门的所有上级父部门路径

     $params = ["id" => "id"];
     $dingding->listParentDeptsByDept($params);     

#### 查询指定用户的所有上级父部门路径

     $params = ["userId" => "userId"];
     $dingding->listParentDepts($params);  
  
#### 获取企业员工人数

     $params = ["onlyActive" => "onlyActive"];
     $dingding->getOrgUserCount($params);                 
 
#### 创建部门

     $dingding->createDepartment($params);          
      
#### 更新部门

     $dingding->updateDepartment($params);     

#### 删除部门

     $params = ["id" => "id"];
     $dingding->deleteDepartment($params);    
           
#### 获取用户待审批数量

     $params = ["userid" => "userid"];
     $dingding->getTodoNum($params);          
      
#### 获取用户可见的审批模板

     $params = ["userid" => "userid", "offset" => "offset", "size" => "size"];
     $dingding->deleteDepartment($params);               
                 
### 问题反馈

　　任何问题欢迎在[Issues](https://github.com/l57t7q/dingding/issues) 中反馈，如果没有账号可以去 我的[博客](https://ltq.im)中留言。

　　你的反馈会让此项目变得更加完美。

### 贡献代码

　　本项目依然不够完善，如果发现bug或有新的功能添加，请在[Issues](https://github.com/l57t7q/dingding/issues)中提交bug(或新功能)描述，在确认后提交你的代码。


### Release Notes

    暂无