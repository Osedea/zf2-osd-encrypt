<?php

namespace OsdCrypt;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'aliases' => array(
                'Crypt' => 'OsdCrypt\Crypt',
            ),
            'factories' => array(
                'OsdCrypt\Crypt' => function ($sm) {
                    $config = $sm->get('Config');

                    return new Options\ModuleOptions(isset($config['osdCrypt']) ? $config['osdCrypt'] : array());
                }
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
