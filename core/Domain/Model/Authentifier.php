<?php

namespace TugasKPL\Domain\Model;

use TugasKPL\Domain\Model\User\UserRepository;
use TugasKPL\Domain\Model\User\User;

abstract class Authentifier
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @param string $repository
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function authenticate($email, $password)
    {
        if ($this->isAlreadyAuthenticated()) {
            return true;
        }

        $user = $this->repository->ofEmail($email);
        if (!$user) {
            return false;
        }

        if ($user->password() !== $password) {
            return false;
        }

        $this->persistAuthentication($user);

        return true;
    }

    abstract public function logout();
    abstract protected function persistAuthentication(User $user);
    abstract protected function isAlreadyAuthenticated();
}