<?php
/**
 * Sso 的 Sesssion 控制模块
 *
 */
namespace Ltbl\SsoService;

trait SessionOperation 
{
    private $session;
    private $sidKeyName;
    private $userInfoKeyName;
    
    private function getSessionValue($key)
    {
        return $this->session->get($key);
    }

    private function forgetSessionValue($key)
    {
        $this->session->forget($key);
    }

    private function putSessionValue($key, $data)
    {
        $this->session->put($key, $data);
    }

    public function putSidInSession($token)
    {
        $this->putSessionValue($this->sidKeyName, $token);
    }

    public function putUserInfoInSession($userInfo)
    {
        $this->putSessionValue($this->userInfoKeyName, $userInfo);
    }

    public function forgetSidFromSession()
    {
        $this->forgetSessionValue($this->sidKeyName);
    }

    public function forgetUserInfoFromSession()
    {
        $this->forgetSessionValue($this->userInfoKeyName);
    }

    public function flushSsoSession()
    {
        $this->forgetSidFromSession();
        $this->forgetUserInfoFromSession();
    }

    public function getSidFromSession()
    {
        return $this->getSessionValue($this->sidKeyName);
    }

    public function getUserInfoFromSession()
    {
        return $this->getSessionValue($this->userInfoKeyName);
    }
}