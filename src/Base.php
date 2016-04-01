<?php
/**
 * SSO HTTP 请求内部请求模块
 *
 */
namespace Ltbl\SsoService;

use Log;
use Config;
use GuzzleHttp\Client;

use Ltbl\SsoService\SessionOperation;
use Ltbl\SsoService\SsoException;

class Base
{   
    use SessionOperation;
    protected $client;
    
    public function __construct()
    {
        // 爬虫主体
        $this->client = new Client;
         // 会话调用
        $this->session = session();
        $this->sidKeyName = Config::get('ssolua.sessionSid');
        $this->userInfoKeyName = Config::get('ssolua.sessionUserInfo');
        $this->ssoTokenUrl = Config::get('ssolua.ssoTokenUrl');
        $this->ssoSidUrl = Config::get('ssolua.ssoSidUrl');
        $this->ssoUserInfoUrl = Config::get('ssolua.ssoUserInfoUrl');
        $this->ssoLogoutUrl = Config::get('ssolua.ssoLogoutUrl');
       
    }
    
    // private function checkConfigExist($key)
    // {
    //     $value = Config::get($key);
    //     if (! $value) {
    //         throw SsoException::fromNonExistingConfig($key);
    //     }

    //     return $value;
    // }

    protected function setQuery($args)
    {
        if (! $args) return '';
        $query = [];
        foreach ($args as $key => $value) {
            $query[] = $key . '=' . $value;
        }
        
        return implode($query, '&');
    }

    protected function get($url, $args)
    {
        $query = $this->setQuery($args);
        
        $url .= '?' . $query;

        $res = $this->client->request('get', $url);
        if($res->getStatusCode() != 200) {
            Log::error('HTTP错误: SSOURL连接出错');
            throw SsoException::httpWithSsoServerError($url);
        }

        return $res->getBody();
    }

    protected function post($url, $args)
    {
        $res = $this->client->request('post', $url, ['form_params' => $args]);
        
        if($res->getStatusCode() != 200) {
            Log::error('HTTP错误: SSOURL连接出错');
            throw SsoException::httpWithSsoServerError($url);
        }

        return $res->getBody();
    }

    /**
     * 获得SID的相关的信息
     *
     * @param string $url 下载地址
     * @return bool
     */
    public function getSidInfo()
    {
        $token2 = $this->getSidFromSession();

        if (! $token2) return false;
        
        $content = $this->get($this->ssoSidUrl, ['token2' => $token2]);
        $content = json_decode($content);
        
        if (! $content) {
            return false;
        } 
        // 当返回的为error, 表示 sid不存在sso, 需要清掉本地sid，重新申请个
        if ($content->code == 'error') {
            $this->flushSsoSession();
            return false;
        }
        // 当返回OK, 而且含有数据用户数据
        if ($content->code == 'ok' && isset($content->userInfo)) {
            $this->putUserInfoInSession($content->userInfo);
        } else {
            $this->forgetUserInfoFromSession();
        }
        
        return true;
    }

    /**
     * 检验一次性的TOKEN，获得相同的SID
     *
     * @param string $onceToken 一次验证TOKEN
     * @return bool
     */
    public function checkOnceToken($onceToken)
    {
        $content = $this->get($this->ssoTokenUrl, ['token1' => $onceToken]);

        $content = json_decode($content);
        if (! $content) return false;
        
        if ($content->code == 'ok') {
            $this->putSidInSession($content->key);
        }
            
        return true;
    }

    // 删除同步的TOKEN登录数据
    public function deleteToken()
    {
        $token = $this->getSidFromSession();
        
        if (! $token) return false;
        
        $content = $this->get($this->ssoLogoutUrl, ['token2' => $token]);
        $content = json_decode($content);
        
        if (! $content) return false;
        
        if ($content->code == 'ok') {
            $this->putUserInfoInSession($content->userInfo);
        }

        return true;
    }
}