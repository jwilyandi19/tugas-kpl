<?php

namespace Phalcon\Init\User\Controllers\Web;

use Phalcon\Session\Adapter\Files as Session;
use TugasKPL\Domain\Model\Authentifier;
use TugasKPL\Domain\Model\User\User;

class SessionAuthentifier extends Authentifier
{
    /**
     * @var Session
     */
    private $session;

    public function __construct($repository, $session)
    {
        parent::__construct($repository);
        $this->session = $session;
    }

    protected function persistAuthentication(User $user)
    {
        $this->session->set('user', $user->id());
    }

    public function isAlreadyAuthenticated()
    {
        return $this->session->has('user');
    }

    public function logout()
    {
        return $this->session->destroy();
    }
}
