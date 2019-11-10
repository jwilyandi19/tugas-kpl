<?php

namespace TugasKPL\Application\Service\Idea;

use TugasKPL\Domain\Model\Idea\IdeaRepository;
use TugasKPL\Domain\Model\User\UserRepository;
use TugasKPL\Domain\Model\User\UserDoesNotExistException;



abstract class IdeaService {
    protected $ideaRepository;
    protected $userRepository;

    public function __construct(IdeaRepository $ideaRepository,UserRepository $userRepository) {
        $this->ideaRepository = $ideaRepository;
        $this->userRepository = $userRepository;
    }

    protected function findUserOrFail($userId) {
        $user = $this->userRepository->ofId($userId);
        if (null === $user) {
            throw new UserDoesNotExistException();
        }
        return $user;
    }  
    

    
}