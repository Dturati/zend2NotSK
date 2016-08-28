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

	//$produto2 = $di->get('SON\Teste');
	$di->instanceManager()->addTypePreference('SON\Db\Connection','conexao1'); #Adiciona preferencia
	$conexao1 = $di->get('conexao1');
	//$david = $di->get('SON\David');
	//echo $produto === $produto2; //Objetos difrentes, interessante
	//$categoria = $di->get('SON\Categoria',array('db' => 'conexao1'));
	#print_r($categoria);die;

	$produto = $di->get('SON\Produto',array('db' => $conexao1));
	#print_r($produto);

	//$di = new Zend\Di\Di;
	$di->configure(new Zend\Di\Config(array(
		'definition' => array(
			'class' => array(
				'SON\Produto' => array(
					'addCategoria' => array(
					'categoria' => array('type'=>'SON\CategoriaInterface','required' => true),
				)
			)
			)
		),
		'instance' => array(
			'SON\Produto' => array(
				'injection' => array(
					'SON\Categoria',
					'SON\Category',
				)
			)
		)
	)));
	$produto = $di->get('SON\Produto');
	print_r($produto);
	//@Zend\Di\Display\Console::export($di);
	//$conexao = new SON\Db\Connection("localhost","zend_intermediario","root","root");
	//$categoria = new \SON\Categoria($conexao);
