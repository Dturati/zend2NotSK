<?php

	require_once "Zend/Loader/StandardAutoloader.php";
	$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf' => true));
	$loader->registerNamespace('SON','SON');
	$loader->register();

/*
	$exemplo = new SON\Event\Exemplo();
	$exemplo->getEventManager()->attach('metodo',function($e){
			echo "<br>".$e->getName()."<br>";
			echo get_class($e->getTarget())."<br>";
			echo $e->getParam('valor');
	});
*/
/*
$events = new Zend\EventManager\SharedEventManager();
$events->attach('SON\Event\Exemplo',array('metodo','metodo2'),function($e){
	echo "<br>".$e->getName()."<br>";
	echo get_class($e->getTarget())."<br>";
	echo $e->getParam('valor');
});
*/
/*
$events->attach('SON\Event\Exemplo','metodo2',function($e){
	echo "<br>".$e->getName()."<br>";
	echo get_class($e->getTarget())."<br>";
	echo $e->getParam('valor');
});
*/




$events = new Zend\EventManager\SharedEventManager();
/*
$events->attach('SON\Event\Exemplo','metodo2',function($e){
	echo "<br>".$e->getName()."<br>";
	echo get_class($e->getTarget())."<br>";
	echo $e->getParam('valor');
},-200);
*/

$events->attach('SON\Event\Exemplo','multiplosEventos.pre',function($e){
	echo "Executou pre"."<br>";
});
$events->attach('SON\Event\Exemplo','multiplosEventos.post',function($e){
	echo "executou post";
},1);
#var_dump($events->getEvents('SON\Event\Exemplo'));
#echo "<br>";
#var_dump($events->getListeners('SON\Event\Exemplo'));
$exemploListener = new SON\Event\ExemploListener();
$exemplo = new SON\Event\Exemplo();
$exemplo->getEventManager()->attachAggregate($exemploListener);
//$exemplo->getEventManager()->setSharedmanager($events);
#$exemplo->metodo(20);
//$exemplo->metodo2();
#print_r($exemplo->metodo3(10));
$exemplo->multiplosEventos(10);
