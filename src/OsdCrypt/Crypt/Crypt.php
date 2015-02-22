<?php

namespace OsdCrypt\Crypt;

use OsdCrypt\Options\ModuleOptions;
use Zend\Crypt\BlockCipher;
use Zend\Filter\File\Decrypt;
use Zend\Filter\File\Encrypt;

class Crypt
{
    protected static $options;

    protected static $keyLocator;

    public static function init(ModuleOptions $options)
    {
        self::$options = $options;
        self::$keyLocator = $options->getCryptKeyLocator();
    }

    /**
     *
     * Prepends $salt provided by CryptKeyLocator
     * and then hashes the value.
     *
     * @param $value
     * @return string
     */
    public static function hash($value)
    {
        $salt = call_user_func(array(self::$keyLocator, 'getSalt'));

        return hash('SHA256', $salt . $value);
    }

    /**
     *
     * Encrypts using PHP mycrypt AES algorithm.
     * Returns empty value if an empty value is
     * given.
     *
     * @param $decrypted
     * @return string
     */
    public static function encrypt($decrypted)
    {
        if (empty($decrypted)) {
            return $decrypted;
        }

        $key = call_user_func(array(self::$keyLocator, 'getKey'));

        $blockCipher = BlockCipher::factory('mcrypt', array('algo' => 'aes'));

        $blockCipher->setKey($key);

        return $blockCipher->encrypt($decrypted);
    }

    /**
     *
     * Decrypts a mcrypt/AES encrypted string. Returns
     * empty value if an empty value is given.
     *
     * @param $encrypted
     * @return bool|string
     */
    public static function decrypt($encrypted)
    {
        if (empty($encrypted)) {
            return $encrypted;
        }

        $key = call_user_func(array(self::$keyLocator, 'getKey'));

        $blockCipher = BlockCipher::factory('mcrypt', array('algo' => 'aes'));

        $blockCipher->setKey($key);

        return $blockCipher->decrypt($encrypted);
    }

    /**
     *
     * Encryptes a file, returning the encrypted
     * data.
     *
     * @param $input
     * @param $output
     * @return array|string
     */
    public static function encryptFile($input, $output)
    {
        $key = call_user_func(array(self::$keyLocator, 'getKey'));

        $options = compact($key);

        $encrypt = new Encrypt($options);

        $encrypt->setFilename($output);

        return $encrypt->filter($input);
    }

    /**
     *
     * Decrypts a file, returning the
     * unencrypted data
     *
     * @param $input
     * @param $output
     * @return array|string
     */
    public static function decryptFile($input, $output)
    {
        $key = call_user_func(array(self::$keyLocator, 'getKey'));

        $options = compact($key);

        $decrypt = new Decrypt($options);

        $decrypt->setFilename($output);

        return $decrypt->filter($input);
    }
}
