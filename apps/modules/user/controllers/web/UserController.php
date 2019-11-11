<?php

namespace Phalcon\Init\User\Controllers\Web;

use Phalcon\Init\User\Controllers\Web\MySQLPdo;
use Phalcon\MVC\Controller;
use TugasKPL\Infrastructure\Persistence\Sql\SqlUserRepository;
use Phalcon\Init\User\Controllers\Web\SessionAuthentifier;
use Phalcon\Session\Adapter\Files as Session;

class UserController extends Controller
{

    /**
     * @var SessionAuthentifier
     */
    private $sessionAuth;

    public function onConstruct(){
        $mysqlpdoBuilder = new MySQLPdo();
        $mysqlpdo = $mysqlpdoBuilder->build();
        $sqlUserRepository = new SqlUserRepository($mysqlpdo);
        $session = new Session();
        $this->sessionAuth = new SessionAuthentifier($this->sqlUserRepository, $session);
    }
    
    public function indexAction()
    {
        $this->view->setVar("isAuth", $this->sessionAuth->isAlreadyAuthenticated());
        $this->view->pick("index/index");
    }
}