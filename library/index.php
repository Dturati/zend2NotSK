<?php
	require_once "Zend/Loader/StandardAutoloader.php";
	$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf' => true));
	$loader->registerNamespace('SON','SON');
	$loader->register();


	$definitionList = new Zend\Di\DefinitionList(array(
		new Zend\Di\Definition\ArrayDefinition(include __DIR__.'/../data/di/SON-definition.php'),
		$runtime = new Zend\Di\Definition\RuntimeDefinition()
	));

	$di = new \Zend\Di\Di($definitionList);
	//passando parametros

/*
	$di->instanceManager()->setParameters('SON\Db\Connection',array(
		'server' 	=> 'localhost',
		'dbName'	=> 'zend_intermediario',
		'user'		=> 'root',
		'password'	=> 'root',
	));
	*/


	$di->instanceManager()->addAlias('produto','SON\Produto'); #Apelido
	$di->instanceManager()->addAlias('connection','SON\Db\Connection'); #Apelido

	$di->instanceManager()->addAlias('conexao1','SON\Db\Connection',array(
		'server' 	=> 'localhost',
		'dbName'	=> 'zend_intermediario',
		'user'		=> 'root',
		'password'	=> 'root',
	));

	//$connection =  $di->get('connection');
	//$produto =  $di->get('produto');
	$conexao1 = $di->get('conexao1');
	//$produto2 = $di->get('SON\Teste');
	$di->instanceManager()->addTypePreference('SON\Db\Connection','conexao1'); #Adiciona preferencia

	$david = $di->get('SON\David');
	//echo $produto === $produto2; //Objetos difrentes, interessante
	$categoria = $di->get('SON\Categoria',array('db' => 'conexao1'));
	print_r($categoria);die;
	//@Zend\Di\Display\Console::export($di);
	//$conexao = new SON\Db\Connection("localhost","zend_intermediario","root","root");
	//$categoria = new \SON\Categoria($conexao);
