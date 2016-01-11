<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 06/11/2015
 * Time: 15:52
 */

namespace Produit;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Produit\Model\Produit;
use Produit\Model\ProduitTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
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

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Produit\Model\ProduitTable' =>  function($sm) {
                    $tableGateway = $sm->get('ProduitTableGateway');
                    $table = new ProduitTable($tableGateway);
                    return $table;
                },
                'ProduitTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Produit());
                    return new TableGateway('produit', $dbAdapter, null, $resultSetPrototype);
                },
                
            ),
        );
    }


}

?>