# Lua SSO 文档


# 安装环境
1.lua 5.1

2.redis

3.openresty

4.luarocks

5.luarocks install lapis

安装环境的坑
   一、安装luarocks
   二、安装openresty
   三、安装lapis
   四、如果使用moon脚本，那得安装MoonScript
   坑有：lua5.1 5.2同时存在，默认是的Lua是5.2的，实际nginx用的是5.1然后干掉5.2的正常了
   openresty的nginx环境需要使用到，不能直接使用标准的nginx
   export LAPIS_OPENRESTY

   lapi new —lua 为选择LUA格式的代码
   不选为选择MOON的格式
    切换的时候需要去掉的nginx.conf
    
# 运行

    /usr/local/openresty/nginx/sbin/nginx server 

---

# 可使用接口

#### 1. **{Host}/sso.js**

用途：请求同步会话，用于APP端同步，会返回一次性token到app和UC端同步一次sid

请求方式：**GET**

| 参数        | 类型   |  备注  |
| :--------:   | :-----:  | :----:  |
| name     |string |  应用名称[必填]    |
|  -  |  - |  - |
| 返回         |  render   |      |
|   -  |   -  |   -   |



#### 2. **{Host}/sso/checkoncetoken**

用途：检验一次性token的有效

请求方式：**GET**

| 参数        | 类型   |  备注  |
| :--------:   | :-----:  | :----:  |
| token1     |string |  一次性token     |
|  -  |  - |  - |
| 返回         |  json   |      |
|  code   |  string   |   状态码[ok, error]   |
|  key   |  string   |     sid值[可选] |
|  msg   |  string   |   提示信息[可选]   |


#### 3. **{Host}/sso/getsiddata**

用途：获取SID里信息，主要是获取用户信息

请求方式：**GET**

| 参数        | 类型   |  备注  |
| :--------:   | :-----:  | :----:  |
| token2     |string |  sid的token     |
|  -  |  - |  - |
| 返回         |  json   |      |
|  code   |  string   |   状态码[ok, error]   |
|  userInfo   |  string   |     用户信息[可选，json格式] |
|  msg   |  string   |   提示信息[可选]   |

#### 4. **{Host}/sso/adduserdata**

用途：添加用户信息到sid

请求方式：**POST**

| 参数        | 类型   |  备注  |
| :--------:   | :-----:  | :----:  |
| token2     |string |  sid的token     |
| user_info     |string |  sid的用户信息     |
|  -  |  - |  - |
| 返回         |  json   |      |
|  code   |  string   |   状态码[ok, error]   |
|  msg   |  string   |   提示信息[可选]   |


#### 5. **{Host}/sso/logout**

用途：退出SSO，清除掉sid的用户信息

请求方式：**GET**

| 参数        | 类型   |  备注  |
| :--------:   | :-----:  | :----:  |
| token2     |string |  sid的token     |
|  -  |  - |  - |
| 返回         |  json   |      |
|  code   |  string   |   状态码[ok, error]   |
|  msg   |  string   |   提示信息   |



---
# Redis 值设定

| key        |  备注  |
| :--------:   | :----:  |
| sso:oncetoken:{token1}     | 一次性的token1     |
| sso:token2:{token2}     | token2的记录     |
| sso:userInfo:{token2}     | token2的用户记录     |



# config.lua配置

把config.lua.example拷贝成config.lua文件
  
  
    --会话名
    session_name = "ttigame_session", 
    --秘钥
    secret = "dADAU6MEhj8YuC", 
    --nginx工作数
    num_workers = 1,
    --服务开放端口
    port = 82,
    --redis配置
    redis = {
        host = '127.0.0.1',
        port = 6379
    },
    --app接入服务配置，uc必须
    app_hosts = {
        app1 = 'http://app1.sso1.cl:8081/ssotoken',
        app2 = '',
        uc = '',
    },
    
    
# 搭配使用 Laravel 框架包

https://github.com/alenslan/SsoService