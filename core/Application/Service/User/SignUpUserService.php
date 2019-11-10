<?php

namespace TugasKPL\Application\Service\User;

use TugasKPL\Application\Service\User\SignUpUserRequest;
use TugasKPL\Domain\Model\User\User;
use TugasKPL\Domain\Model\User\UserAlreadyExistsException;
use TugasKPL\Domain\Model\User\UserRepository;
use TugasKPL\Application\DataTransformer\UserDataTransformer;

class SignUpUserService
{
    private $userRepository;
    private $userDataTransformer;

    public function __construct(
        UserRepository $userRepository,
        UserDataTransformer $userDataTransformer
    ) {
        $this->userRepository = $userRepository;
        $this->userDataTransformer = $userDataTransformer;
    }

    /**
     * @param SignUpUserRequest $request
     *
     * @return User
     *
     * @throws UserAlreadyExistsException
     */
    public function execute($request = null)
    {
        $email = $request->email();
        $password = $request->password();

        $user = $this->userRepository->ofEmail($email);
        if (null !== $user) {
            throw new UserAlreadyExistsException();
        }

        $ksuid = new Ksuid;

        $user = new User(
            $ksuid,
            $email,
            $password
        );

        $this->userRepository->add($user);
        $this->userDataTransformer->write($user);
        return $this->userDataTransformer->read();
    }
}
