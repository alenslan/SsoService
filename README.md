# SsoService文档


---
## 相关依赖
    "require": {
        "php": ">=5.5.0",
        "laravel/framework": "5.1.*",
        "guzzlehttp/guzzle" : "~6.0"
    },
    
## 安装 
添加到composer.json

    "require": {
        "Ltbl/SsoService": "~1.*"
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
##接口文档

#### **Ltbl\SsoService\Client**
app应用端类

    /**
     * 通过sid去sso server获得数据
     *
     * @return bool
     */
    public function getSidInfo()
    
    /**
     * 检验一次性的TOKEN，获得相同的SID
     *
     * @param string $onceToken 一次验证TOKEN
 * @return bool
 */
 public function checkOnceToken($onceToken)

    /**
     * 清除掉token2的信息
     *
     * @return bool
     */
    public function deleteToken()
    
    
    /**
     * 检查会话里是否登录
     *
     * @return bool
     */
    public function checkSsoAuth()
    
    
    /**
     * 检查会话里是否有sid信息
     *
     * @return bool
     */
    public function checkSsoSid()


---

#### **Ltbl\SsoService\Server**

用户服务端类
    
    /**
     * 检查会话里是否有sid信息
     *
     * @return bool
     */
    public function getSidInfo()
    
    /**
     * 检查一次性token1的存在，如果存在返回token2的参数
     *
     * @return bool
     */
    public function checkOnceToken($onceToken)

    /**
     * 发送用户数据
     *
     * @params array $userInfo 用户信息
 * @return bool
 */
 public function postUserInfo($userInfo)


# config.php 说明

    // sid的key名称
    'sessionSid' => 'sid',
    // 用户信息的名称
    'sessionUserInfo' => 'userInfo',
    // 请求一次性TOKEN
    'ssoTokenUrl' => 'http://127.0.0.1:82/checkoncetoken',
    // 获得SID的状态信息
    'ssoSidUrl' => 'http://127.0.0.1:82/getsiddata',
    // 发送用户数据，主要用于登录发送用户数据
    'ssoUserInfoUrl' =>     'http://127.0.0.1:82/sso/adduserdata',
    // 登出请求 用于APP应用端
    'ssoLogoutUrl' => 'http://127.0.0.1:82/sso/logout',

# APP 端同步js调用
    
    当sid不存在的时候,需要调用同步js,name为分配给自己的app1代码[用户中心使用AJAX提交]
    
    @if(! Session::has('sid'))
        <script type="text/javascript" src="http://sso.sso.cl:8082/sso.js?name=app1"></script>
    @endif

# App oncetoken方法
    
    $onceToken = Input::get('token');
    if ($onceToken)
    {
        $client = new Ltbl\SsoService\Client();
        $client->checkOnceToken($onceToken);
    }