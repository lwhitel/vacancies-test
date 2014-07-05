<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ivan Neskorodev
 * Date: 05.07.14
 * Time: 18:00
 * To change this template use File | Settings | File Templates.
 */

namespace Vacancy;

use Zend\Db\ResultSet\ResultSet;

class Module {

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

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

}