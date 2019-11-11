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
        $this->loginService = new LogInUserService($this->sessionAuth);
    }

    public function indexAction(){
        if ($this->sessionAuth->isAlreadyAuthenticated()){
            $this->view->setVar("isAuth", true);
            return $this->response->redirect("/../../");
        }
        $this->view->setVar("isAuth", false);
        $this->view->pick('login/index');
    }

    public function loginAction(){
        // Check if the event is post request
        if ($this->request->isPost()) {
            $email = $this->request->getPost($this->userNameRequestKey);
            $password = $this->request->getPost($this->userPassRequestKey);
            if($this->sessionAuth->isAlreadyAuthenticated()){
                $this->sessionAuth->logout();
            }
            $isAuthenticated = $this->loginService->execute($email, $password);
            if ($isAuthenticated) {
                $user = $this->sqlUserRepository->ofEmail($email);
                $this->view->setVar("isAuth", true);
                return $this->response->redirect("/../");
            } else {
                $this->view->setVar("isAuth", false);
                return $this->response->redirect("/../login");
            }
        }
    }

    public function logoutAction(){
        if ($this->sessionAuth->isAlreadyAuthenticated()){
            $this->sessionAuth->logout();
            $this->view->setVar('isAuth', false);
            return $this->response->redirect("/../");
        }
    }
}