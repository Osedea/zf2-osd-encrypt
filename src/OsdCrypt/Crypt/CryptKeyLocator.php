<?php

namespace OsdCrypt\Crypt;

class CryptKeyLocator implements CryptKeyLocatorInterface
{
    protected static $memcached;

    protected static $config;

    /**
     * @param $config
     * @param $memcached
     * @throws \Exception
     */
    public static function init($config, $memcached)
    {
        self::$config = $config["remote"];
        self::$memcached = $memcached;

        if (!self::getKey() || !self::getSalt()) {
            self::scpFile('/var/tmp/keys.txt');
            self::setKeysFromFile('/var/tmp/keys.txt');
        }
    }

    /**
     * @return mixed
     */
    public static function getKey()
    {
        return self::$memcached->getItem('key');
    }

    /**
     * @return mixed
     */
    public static function getSalt()
    {
        return self::$memcached->getItem('salt');
    }

    /**
     * @param $local_path
     * @throws \Exception
     */
    private static function scpFile($local_path)
    {
        $conn = ssh2_connect(self::$config['ip'], self::$config['port'], self::$config['methods']);

        if (!ssh2_auth_pubkey_file($conn, self::$config['user'], self::$config['pub_key_file'], self::$config['priv_key_file'])) {
            throw new \Exception('Unable to connect via SSH.');
        }

        ssh2_scp_recv($conn, self::$config['remote_path'], $local_path);
    }

    /**
     * @param $file
     * @throws \Exception
     */
    private static function setKeysFromFile($file)
    {
        $rows = explode("\n", file_get_contents($file));

        if (file_exists($file)) {
            unlink($file);
        }

        if (count($rows) < 2) {
            throw new \Exception('Remote file did not contain the correct number of rows.');
        }

        self::$memcached->setItem('key', $rows[0]);
        self::$memcached->setItem('salt', $rows[1]);
    }
}
