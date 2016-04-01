<?php
/**
 * SSOLUA连接的配置文件
 *
 */
return [
    // sid的key名称
    'session.sid' => 'sid',
    // 用户信息的名称
    'session.userInfo' => 'userInfo',
    // 请求一次性TOKEN
    'ssoTokenUrl' => '',
    // 获得SID的状态信息
    'ssoSidUrl' => '',
    // 发送用户数据，主要用于登录发送用户数据
    'ssoUserInfoUrl' => '',
    // 登出请求 用于APP应用端
    'ssoLogoutUrl' => '',
];

