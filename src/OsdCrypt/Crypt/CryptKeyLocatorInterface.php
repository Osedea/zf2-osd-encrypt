<?php

namespace OsdCrypt\Crypt;

interface CryptKeyLocatorInterface
{
    /**
     * @return mixed
     */
    public static function getKey();

    /**
     * @return mixed
     */
    public static function getSalt();
}