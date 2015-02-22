<?php

namespace OsdCrypt\Crypt;

use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class CryptKeyLocator implements CryptKeyLocatorInterface
{
    /**
     * @return mixed
     */
    public static function getKey()
    {
        return 'This is not a real key.';
    }

    /**
     * @return mixed
     */
    public static function getSalt()
    {
        return 'This is not a real salt.';
    }
}
