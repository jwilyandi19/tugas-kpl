<?php

namespace TugasKPL\Domain\Model\User;

interface UserRepository
{
    /**
     * @param int $userId
     *
     * @return User
     */
    public function ofId($userId);
    
    /**
     * @param string $email
     *
     * @return User
     */
    public function ofEmail($email);

    /**
     * @param User $user
     */
    public function add(User $user);
}