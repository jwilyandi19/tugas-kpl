<?php

namespace Phalcon\Init\User;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $baseInfrastructure = '/../../../core/Infrastructure';
        $loader->registerNamespaces([
            'Phalcon\Init\User\Controllers\Web' => __DIR__ . '/controllers/web',
            'Phalcon\Init\User\Controllers\Api' => __DIR__ . '/controllers/api',
            'Phalcon\Init\User\Models' => __DIR__ . '/models',
            'TugasKPL\Infrastructure\Persistence\Sql' => __DIR__ . $baseInfrastructure . '/Persistence/Sql' 
        ]);
        $loader->register();
    }

    public function registerServices(DiInterface $di = null)
    {
        $moduleConfig = require __DIR__ . '/config/config.php';

        $di->get('config')->merge($moduleConfig);

        include_once __DIR__ . '/config/services.php';
    }
}