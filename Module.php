<?php

namespace OsdCrypt;

use OsdCrypt\Crypt\Crypt;
use OsdCrypt\Options\ModuleOptions;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\ModuleManager;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/vendor/composer/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function init(ModuleManager $mm)
    {
        $config = $this->getConfig();

        $cryptConfig = isset($config['osdCrypt']) ? $config['osdCrypt'] : array();

        $moduleOptions = new ModuleOptions($cryptConfig);

        Crypt::init($moduleOptions);
    }
}
