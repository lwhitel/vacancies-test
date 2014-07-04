<?php
/**
 * Created by JetBrains PhpStorm.
 * User: White
 * Date: 04.06.14
 * Time: 22:47
 * To change this template use File | Settings | File Templates.
 */
namespace MyUser;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
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
}