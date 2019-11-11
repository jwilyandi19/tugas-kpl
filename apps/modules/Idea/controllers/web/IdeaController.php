<?php

namespace Phalcon\Init\Idea\Controllers\Web;

use Phalcon\Init\User\Controllers\Web\MySQLPdo;
use Phalcon\MVC\Controller;
use TugasKPL\Application\Service\Idea\ViewAllIdeasService;
use TugasKPL\Infrastructure\Persistence\Sql\SqlIdeaRepository;
use TugasKPL\Infrastructure\Persistence\Sql\SqlUserRepository;
use Phalcon\Init\User\Controllers\Web\SessionAuthentifier;
use Phalcon\Session\Adapter\Files as Session;

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
        $session = new Session();
        $this->sessionAuth = new SessionAuthentifier($sqlUserRepository, $session);
    }
    
    public function indexAction() {
        $ideas = $this->viewAllIdeasService->execute();
        $this->view->setVar("isAuth", $this->sessionAuth->isAlreadyAuthenticated());
        $this->view->setVar("ideas", $ideas);
        $this->view->pick('index/index');
    }
}