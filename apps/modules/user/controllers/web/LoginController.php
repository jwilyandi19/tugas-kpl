<?php

namespace Phalcon\Init\User\Controllers\Web;

use Phalcon\Init\User\Controllers\Web\MySQLPdo;
use Phalcon\MVC\Controller;
use TugasKPL\Application\DataTransformer\UserDataTransformerImpl;
use TugasKPL\Application\Service\User\LogInUserService;
use TugasKPL\Infrastructure\Persistence\Sql\SqlUserRepository;
use Phalcon\Init\User\Controllers\Web\SessionAuthentifier;
use Phalcon\Session\Adapter\Files as Session;

class LoginController extends Controller{
    
    /**
     *  @var LogInUserService
     */
    private $loginService;

    /**
     * @var SessionAuthentifier
     */
    private $sessionAuth;

    /**
     * @var SqlUserRepository
     */ 
    private $sqlUserRepository;

    private $userNameRequestKey = "email";
    private $userPassRequestKey = "password";
    
    public function onConstruct(){
        $mysqlpdoBuilder = new MySQLPdo();
        $mysqlpdo = $mysqlpdoBuilder->build();
        $this->sqlUserRepository = new SqlUserRepository($mysqlpdo);
        $session = new Session();
        $this->sessionAuth = new SessionAuthentifier($this->sqlUserRepository, $session);
        $this->signUpService = new LogInUserService($this->sessionAuth);
    }

    public function indexAction(){
        if ($this->sessionAuth->isAlreadyAuthenticated()){
            return $this->response->redirect("tugas-kpl");
        }
        $this->view->pick('login/index');
    }

    public function loginAction(){
        // Check if the event is post request
        if ($this->request->isPost()) {
            $email = $this->request->getPost($this->userNameRequestKey);
            $password = $this->request->getPost($this->userPassRequestKey);
            $isAuthenticated = $this->loginService->execute($email, $password);
            if ($isAuthenticated) {
                $user = $this->sqlUserRepository->ofEmail($email);
                $this->sessionAuth->persistAuthentication($user);
                return $this->response->redirect("tugas-kpl");
            } else {
                return $this->response->redirect("tugas-kpl/user/login");
            }
        }
    }
}