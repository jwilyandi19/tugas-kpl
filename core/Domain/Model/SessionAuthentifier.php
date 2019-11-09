<?php

namespace TugasKPL\Domain\Model;

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
        $this->session->set('user', UserSecurityToken::fromUser($user));
    }

    protected function isAlreadyAuthenticated()
    {
        return $this->session->has('user');
    }

    public function logout()
    {
        return $this->session->clear();
    }
}
