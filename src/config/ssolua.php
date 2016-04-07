<?php
/**
 * SSOLUA连接的配置文件
 *
 */
return [
    // sid的key名称
    'sessionSid' => 'sid',
    // 用户信息的名称
    'sessionUserInfo' => 'userInfo',
    // 请求一次性TOKEN
    'ssoTokenUrl' => 'http://127.0.0.1:82/checkoncetoken',
    // 获得SID的状态信息
    'ssoSidUrl' => 'http://127.0.0.1:82/getsiddata',
    // 发送用户数据，主要用于登录发送用户数据
    'ssoUserInfoUrl' => 'http://127.0.0.1:82/sso/adduserdata',
    // 登出请求 用于APP应用端
    'ssoLogoutUrl' => 'http://127.0.0.1:82/sso/logout',
];

