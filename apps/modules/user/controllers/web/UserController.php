<?php

namespace Phalcon\Init\User\Controllers\Web;

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        $this->view->pick('dashboard/index');
    }

}