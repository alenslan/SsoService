<?php
/**
 * SSO UC端 请求内部请求模块
 *
 */
namespace Ltbl\SsoService;

use Log;
use Session;
use Ltbl\SsoService\Base;

class Server extends SsoBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function postUserInfo($userInfo)
    {
        if (! $userInfo) {
            return false;
        }
        if (is_array($userInfo)) {
            $userInfo = json_encode($userInfo);
        }
        $token = $this->getSidFromSession();
        $args = [
            'token2' => $token,
            'user_info' => $userInfo
        ];
        $content = $this->post($this->ssoUserInfoUrl, $args);
        $content = json_decode($content);
        if (! $content) {
            return false;
        }
        if ($content->code == 'ok') {
            $this->putUserInfoInSession($content->userInfo);
            return true;
        }
            
        return true;
    }
}
