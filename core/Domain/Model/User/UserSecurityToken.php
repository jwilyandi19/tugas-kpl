<?php

namespace TugasKPL\Domain\Model\User;

/**
 * Class User.
 */
class UserSecurityToken
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var string
     */
    private $email;

    /**
     * @param User $user
     *
     * @return UserSecurityToken
     */
    public static function fromUser(User $user)
    {
        return new self($user->id(), $user->email());
    }

    /**
     * @param string $userId
     * @param string $email
     */
    private function __construct($userId, $email)
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }
}
