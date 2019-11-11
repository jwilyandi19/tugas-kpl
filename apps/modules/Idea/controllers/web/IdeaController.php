<?php

namespace Phalcon\Init\Idea\Controllers\Web;

use Phalcon\Init\User\Controllers\Web\MySQLPdo;
use Phalcon\MVC\Controller;
use TugasKPL\Application\Service\Idea\ViewAllIdeasService;
use TugasKPL\Application\Service\Idea\AddIdeaRatingService;
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

    /**
     * @var AddIdeaRatingService
     */
    private $addIdeaRatingService;

    /**
     *  @var Session 
     */ 
    private $session;

    public function onConstruct() {
        $mysqlpdoBuilder = new MySQLPdo();
        $mysqlpdo = $mysqlpdoBuilder->build();
        $sqlIdeaRepository = new SqlIdeaRepository($mysqlpdo);
        $sqlUserRepository = new SqlUserRepository($mysqlpdo);
        $this->addIdeaRatingService = new AddIdeaRatingService($sqlIdeaRepository, $sqlUserRepository);
        $this->viewAllIdeasService = new ViewAllIdeasService($sqlIdeaRepository, $sqlUserRepository);
        $this->addIdeaService = new AddIdeaService($sqlIdeaRepository, $sqlUserRepository);
        $this->session = new Session();
        $this->sessionAuth = new SessionAuthentifier($sqlUserRepository, $this->session);
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
        // Bad, fix later :)
        $userId = $this->session->get('user');;
        $content = $this->request->getPost("content");
        $description = $this->request->getPost("description");
        $this->addIdeaService->execute($userId,$content,$description);
        $this->response->redirect('/../');
    }

    public function addRatingScoreAction(){
        if ($this->request->isPost()) {
            $ideaId = $this->request->getPost("ideaId");
            $ratingScore = (int) $this->request->getPost("ratingScore");
            $this->addIdeaRatingService->execute($ideaId, $ratingScore);
            return $this->response->redirect('/..');
        }
    }
}