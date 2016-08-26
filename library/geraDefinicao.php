<?php
require_once "Zend/Loader/StandardAutoloader.php";
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf' => true));
$loader->registerNamespace('SON','SON');
$loader->register();

$components  = array('SON'); #Poderia ter mais pastas
foreach ($components as $component)
{
    $diCompiler = new Zend\Di\Definition\CompilerDefinition();
    $diCompiler->addDirectory($component);

    $diCompiler->compile();
    file_put_contents(
        '../data/di/'.$component.'-definition.php',
        '<?php return '. var_export($diCompiler->toArrayDefinition()->toArray(),true).';'
    );

}