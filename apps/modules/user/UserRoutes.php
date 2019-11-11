<?php

namespace Phalcon\Init\User;

use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Init\User\Controllers\Web\SignupController;

class UserRoutes extends RouterGroup
{
    public function initialize()
    {
        $this->setPrefix('/user');

        $this->addGet('',[          
            'namespace' => 'Phalcon\Init\User\Controllers\Web',
            'module' => 'user', 
            'controller' => 'User',
            'action' => 'index'
        ]);
        
        $this->addPost('',[
            'namespace' => 'Phalcon\Init\User\Controllers\Web',
            'module' => 'user',
            'controller' => 'Signup',
            'action' => 'register'
        ]);

        $this->addGet('/signup',[
            'namespace' => 'Phalcon\Init\User\Controllers\Web',
            'module' => 'user',
            'controller' => 'Signup',
            'action' => 'index'
        ]);

        $this->addGet('/login',[
            'namespace' => 'Phalcon\Init\User\Controllers\Web',
            'module' => 'user',
            'controller' => 'Login',
            'action' => 'index'
        ]);
        $this->addPost('/login',[
            'namespace' => 'Phalcon\Init\User\Controllers\Web',
            'module' => 'user',
            'controller' => 'Login',
            'action' => 'login'
        ]);
    }
}