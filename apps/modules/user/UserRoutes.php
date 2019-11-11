<?php

namespace Phalcon\Init\User;

use Phalcon\Mvc\Router\Group as RouterGroup;
use Phalcon\Init\User\Controllers\Web\SignupController;

class UserRoutes extends RouterGroup
{
    public function initialize()
    {
        $this->setPrefix('/user');

        $this->addGet('',
            [          
                'namespace' => 'Phalcon\Init\User\Controllers\Web',
			    'module' => 'user', 
                'controller' => 'User',
                'action' => 'index'
            ]
        );
            
        $this->addGet('/signup',
            [
                'namespace' => 'Phalcon\Init\User\Controllers\Web',
                'module' => 'user',
                'controller' => 'Signup',
                'action' => 'index'
            ]
        );

        $this->addPost('/user',
            [
                'namespace' => 'Phalcon\Init\User\Controllers\Web',
			    'module' => 'user',
                'controller' => 'Signup',
                'action' => 'register'
            ]
        );
    }
}