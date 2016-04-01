<?php
/**
 * Sso的异常行为模块
 *
 */

namespace Ltbl\SsoService;


class SsoException
{
    /**
     * 检查配置里是否存在
     * @param string $key
     *
     * @return self
     */
    public static function fromNonExistingConfig($key)
    {
        return new self(sprintf('The config key "%s" does not exist', $key));
    }

    /**
     * 连接Sso失败
     * @param string $key
     *
     * @return self
     */
    public static function httpWithSsoServerError($url)
    {
        return new self(sprintf('connect url "%s" fail', $url));
    }
}