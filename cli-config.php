<?php
require_once __DIR__.'/vendor/autoload.php';
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
$smModuleArg = false;
foreach ($_SERVER['argv'] as $key => $val) {
    if (preg_match('/--sm-module/', $val)) {
        $smModuleArg = $val;
        unset( $_SERVER['argv'][$key] );
        $_SERVER['argc'] = $_SERVER['argc']-1;
    }
}
if ($smModuleArg) {
    $paths = array(__DIR__ . '\\app\\' . explode(':', $smModuleArg)[1]);
} else {
    $paths = array(__DIR__ . '\\app\\');
}

$isDevMode = true;
$dbParams = include(__DIR__ . '/config/config.php');
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams['database'], $config);
return ConsoleRunner::createHelperSet($entityManager);
//php vendor/doctrine/orm/bin/doctrine.php orm:schema-tool:create