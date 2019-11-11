<?php

namespace TugasKPL\Application\Service\User;

use TugasKPL\Domain\Model\Authentifier;

class LogInUserService
{
    /**
     * @var Authentifier
     */
    private $authenticationService;

    public function __construct(Authentifier $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * @param $email
     * @param $password
     *
     * @return bool
     */
    public function execute($email, $password)
    {
        return $this->authenticationService->authenticate($email, $password);
    }
}