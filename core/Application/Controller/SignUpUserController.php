<?php

namespace TugasKPL\Application\Controller;

use Phalcon\MVC\Controller;
use TugasKPL\Application\Service\User\SignUpUserService;

class SignUpUserController extends Controller{
    
    /**
     *  @var SignUpUserService
     */
    private $signUpService;

    private $userNameRequestKey = "name";
    private $userPassRequestKey = "password";
    
    public function indexAction(){
        $this->view->pick('signup');
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