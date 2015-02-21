<?php

namespace OsdCrypt\Crypt;

use Zend\Crypt\BlockCipher;
use Zend\Filter\File\Decrypt;
use Zend\Filter\File\Encrypt;

class Crypt
{
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
        $salt = CryptKeyLocator::getSalt();

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

        $blockCipher = BlockCipher::factory('mcrypt', array('algo' => 'aes'));

        $blockCipher->setKey(CryptKeyLocator::getKey());

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

        $blockCipher = BlockCipher::factory('mcrypt', array('algo' => 'aes'));

        $blockCipher->setKey(CryptKeyLocator::getKey());

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
        $options = array('key' => CryptKeyLocator::getKey());

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
        $options = array('key' => CryptKeyLocator::getKey());

        $decrypt = new Decrypt($options);

        $decrypt->setFilename($output);

        return $decrypt->filter($input);
    }
}
