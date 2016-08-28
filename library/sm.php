<?php
require_once "Zend/Loader/StandardAutoloader.php";
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf' => true));
$loader->registerNamespace('SON','SON');
$loader->register();

use Zend\ServiceManager\ServiceManager;

$serviceManager = new ServiceManager();

//$serviceManager->setService('produto', new SON\Produto());
//
//$produto = $serviceManager->get('produto');
//print_r($produto);
//$serviceManager->setInvokableClass('Produto','SON\Produto');
//$produto = $serviceManager->get('produto');
//print_r($produto);

//factories
$serviceManager->setService('Connection',new SON\Db\Connection('a','b','c','d'));
$serviceManager->setAlias('Connention','SON\Db\Connection');
//
//$serviceManager->setFactory('Categoria',function ($sm){
//   return new SON\Categoria($sm->get('Connection'));
//});
//
//$categoria = $serviceManager->get('Categoria');
//print_r($categoria);
#$serviceManager->setFactory('Categoria','SON\CategoriaFactory');
$categoria = $serviceManager->get('Connection');
print_r($categoria);

