# SsoService文档


---
## 相关依赖
    "require": {
        "php": ">=5.5.0",
        "guzzlehttp/guzzle" : "~6.0"
    },
    
## 安装 
添加到composer.json

    "require": {
        "Ltbl/SsoService": "~1.0"
    }
    
## 私有包安装 
添加到composer.json
    
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/alenslan/SsoService.git"
        }
    ]
    
##安装完成了后安装配置
添加config/app.php 文件里的

        'providers' => [
            Ltbl\SsoService\SsoServiceProvider::class
        ]

然后运行 

    php artisan vendor:publish
    
查看config/ssolua.php 文件是否存在

---
##使用方法
#### 公用方法

#### Ltbl\SsoService\Client

app应用端类

    public function getSidInfo()
  
| 参数        | 类型   |  备注  |
| --------   | -----:  | :----:  |
| 返回        | bool    |      |
    
    
    public function checkOnceToken($onceToken)

| 参数        | 类型   |  备注  |
| --------   | -----:  | :----:  |
| onceToken     |string |  一次性的token     |
| 返回        | bool    |      |


    public function deleteToken()
    
| 参数        | 类型   |  备注  |
| --------   | -----:  | :----:  |
| 返回        | bool    |      |
    
    
    public function checkSsoAuth()
  
| 参数        | 类型   |  备注  |
| --------   | -----:  | :----:  |
| 返回        | bool    |      |  
    
    
    public function checkSsoSid()
 
| 参数        | 类型   |  备注  |
| --------   | -----:  | :----:  |
| 返回        | bool    |      |   


---

#### Ltbl\SsoService\Server

用户服务端类

    public function getSidInfo()
  
| 参数        | 类型   |  备注  |
| --------   | -----:  | :----:  |
| 返回        | bool    |      |
    
    
    public function checkOnceToken($onceToken)

| 参数        | 类型   |  备注  |
| --------   | -----:  | :----:  |
| onceToken     |string |  一次性的token     |
| 返回        | bool    |      |


    public function postUserInfo($userInfo)
    
| 参数        | 类型   |  备注  |
| --------   | -----:  | :----:  |
| userInfo     |array |  用户信息     |
| 返回        | bool    |      |
    


