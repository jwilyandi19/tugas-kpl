<?php

namespace Phalcon\Init\User\Controllers\Web;

use Phalcon\Init\User\Controllers\Web\MySQLPdo;
use Phalcon\MVC\Controller;
use TugasKPL\Application\DataTransformer\UserDataTransformerImpl;
use TugasKPL\Application\Service\User\SignUpUserService;
use TugasKPL\Application\Service\User\SignUpUserRequest;
use TugasKPL\Infrastructure\Persistence\Sql\SqlUserRepository;
use Phalcon\Init\User\Controllers\Web\SessionAuthentifier;
use Phalcon\Session\Adapter\Files as Session;

class SignupController extends Controller{
    
    /**
     *  @var SignUpUserService
     */
    private $signUpService;

    /**
     * @var SessionAuthentifier
     */
    private $sessionAuth;

    private $userNameRequestKey = "email";
    private $userPassRequestKey = "password";
    
    public function onConstruct(){
        $mysqlpdoBuilder = new MySQLPdo();
        $mysqlpdo = $mysqlpdoBuilder->build();
        $session = new Session();
        $this->sessionAuth = new SessionAuthentifier($this->sqlUserRepository, $session);
        $sqlUserRepository = new SqlUserRepository($mysqlpdo);
        $userDataTransformer = new UserDataTransformerImpl();
        $this->signUpService = new SignUpUserService($sqlUserRepository, $userDataTransformer);
    }

    public function indexAction(){
        if ($this->sessionAuth->isAlreadyAuthenticated()){
            return $this->response->redirect("/../../");
        }
        $this->view->pick('signup/index');
    }

    public function registerAction(){
        // Check if the event is post request
        if ($this->request->isPost()) {
            // Access POST data
            $signupRequest = new SignUpUserRequest(
                $this->request->getPost($this->userNameRequestKey),
                $this->request->getPost($this->userPassRequestKey)
            );
            $response = $this->signUpService->execute($signupRequest);
            return  $this->response->redirect('/../login');
        }
    }
}