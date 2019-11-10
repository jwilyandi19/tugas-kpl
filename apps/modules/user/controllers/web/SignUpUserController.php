<?php

namespace Phalcon\Init\User\Controllers\Web;

use MySQLPdo;
use Phalcon\MVC\Controller;
use TugasKPL\Application\DataTransformer\UserDataTransformerImpl;
use TugasKPL\Application\Service\User\SignUpUserService;
use TugasKPL\Infrastructure\Persistence\Sql\SqlUserRepository;

class SignUpUserController extends Controller{
    
    /**
     *  @var SignUpUserService
     */
    private $signUpService;

    private $userNameRequestKey = "name";
    private $userPassRequestKey = "password";
    
    public function onConstruct(){
        $dbHost = getenv("DB_HOST");
        $dbName = getenv("DB_NAME");
        $dbUsername = getenv("DB_USERNAME");
        $dbPassword = getenv("DB_PASSWORD");
        $mysqlpdo = new MySQLPdo($dbHost, $dbName, $dbUsername, $dbPassword);
        $sqlUserRepository = new SqlUserRepository($mysqlpdo);
        $userDataTransformer = new UserDataTransformerImpl();
        $this->signUpService = new SignUpUserService($sqlUserRepository, $userDataTransformer);
    }

    public function indexAction(){
        $this->view->pick('signup.index');
    }

    public function registerAction(){
        [$userName, $userPass] = ["", ""];
        // Check if the event is post request
        if ($this->request->isPost()) {
            // Access POST data
            $userName = $this->request->getPost($this->userNameRequestKey);
            $userPass = $this->request->getPost($this->userPassRequestKey);
        }

        echo($userName . $userPass);
    }
}