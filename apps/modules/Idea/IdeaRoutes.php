<?php

namespace Phalcon\Init\Idea;

use Phalcon\Mvc\Router\Group as RouterGroup;

class IdeaRoutes extends RouterGroup
{
    public function initialize()
    {
        $this->setPrefix('/idea');

        $this->addGet('',[          
            'namespace' => 'Phalcon\Init\Idea\Controllers\Web',
            'module' => 'idea', 
            'controller' => 'Idea',
            'action' => 'index'
        ]);
    }
}