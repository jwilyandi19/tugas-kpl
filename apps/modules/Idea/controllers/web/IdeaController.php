<?php

namespace Phalcon\Init\Idea\Controllers\Web;

use Phalcon\Init\User\Controllers\Web\MySQLPdo;
use Phalcon\MVC\Controller;
use TugasKPL\Application\Service\Idea\ViewAllIdeasService;
use TugasKPL\Infrastructure\Persistence\Sql\SqlIdeaRepository;
use TugasKPL\Infrastructure\Persistence\Sql\SqlUserRepository;
use Phalcon\Init\User\Controllers\Web\SessionAuthentifier;
use Phalcon\Session\Adapter\Files as Session;
use TugasKPL\Application\Service\Idea\AddIdeaService;

class IdeaController extends Controller{
    /**
     * @var ViewAllIdeasService
     */
    private $viewAllIdeasService;

    /**
     * @var SessionAuthentifier
     */
    private $sessionAuth;

    public function onConstruct() {
        $mysqlpdoBuilder = new MySQLPdo();
        $mysqlpdo = $mysqlpdoBuilder->build();
        $sqlIdeaRepository = new SqlIdeaRepository($mysqlpdo);
        $sqlUserRepository = new SqlUserRepository($mysqlpdo);
        $this->viewAllIdeasService = new ViewAllIdeasService($sqlIdeaRepository, $sqlUserRepository);
        $this->addIdeaService = new AddIdeaService($sqlIdeaRepository, $sqlUserRepository);
        $session = new Session();
        $this->sessionAuth = new SessionAuthentifier($sqlUserRepository, $session);
    }
    
    public function indexAction() {
        $ideas = $this->viewAllIdeasService->execute();
        $this->view->setVar("isAuth", $this->sessionAuth->isAlreadyAuthenticated());
        $this->view->setVar("ideas", $ideas);
        $this->view->pick('index/index');
    }

    public function viewMakeIdeaAction() {
        $this->view->setVar("isAuth", $this->sessionAuth->isAlreadyAuthenticated());
        $this->view->pick("index/create");
    }

    public function makeIdeaAction() {
        $userId = "1";
        $content = $this->request->getPost("content");
        $description = $this->request->getPost("description");
        if($this->sessionAuth->isAlreadyAuthenticated()){
            $this->sessionAuth->logout();
        }
        $this->addIdeaService->execute($userId,$content,$description);
        $this->response->redirect('/../');
    }
}