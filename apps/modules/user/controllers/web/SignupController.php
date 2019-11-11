<?php

namespace Phalcon\Init\User\Controllers\Web;

use Phalcon\Init\User\Controllers\Web\MySQLPdo;
use Phalcon\MVC\Controller;
use TugasKPL\Application\DataTransformer\UserDataTransformerImpl;
use TugasKPL\Application\Service\User\SignUpUserService;
use TugasKPL\Application\Service\User\SignUpUserRequest;
use TugasKPL\Infrastructure\Persistence\Sql\SqlUserRepository;

class SignupController extends Controller{
    
    /**
     *  @var SignUpUserService
     */
    private $signUpService;

    
    private $userNameRequestKey = "email";
    private $userPassRequestKey = "password";
    
    public function onConstruct(){
        $mysqlpdoBuilder = new MySQLPdo();
        $mysqlpdo = $mysqlpdoBuilder->build();
        $sqlUserRepository = new SqlUserRepository($mysqlpdo);
        $userDataTransformer = new UserDataTransformerImpl();
        $this->signUpService = new SignUpUserService($sqlUserRepository, $userDataTransformer);
    }

    public function indexAction(){
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