<?php
/**
 * APP 应用端 请求内部请求模块
 *
 */
namespace Ltbl\SsoService;

use Ltbl\SsoService\Base;

class Client extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkSsoAuth()
    {
        return $this->getUserInfoFromSession();
    }

    public function checkSsoSid()
    {
        return $this->getSidFromSession();
    }
}
