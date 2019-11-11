<?php

namespace Phalcon\Init\User\Controllers\Web;

use Phalcon\Init\User\UserRoutes;
use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        $this->view->pick("index/index");
    }
}