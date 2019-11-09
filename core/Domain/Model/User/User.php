<?php

namespace TugasKPL\Domain\Model\User;

class User {
    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $email;
    
    /**
     * @var string
     */
    protected $password;

    /** 
     * @var ArrayCollection
     */
    protected $ideas;

    /**
     * @param int $userId
     * @param string $email
     * @param string $password
     */
    public function __construct($userId, $email, $password)
    {
        $this->userId = $userId;
        $this->setEmail($email);
        $this->changePassword($password);
        $this->ideas = new ArrayCollection();
    }

    /**
     * @param string $email
     */
    protected function setEmail($email)
    {
        $email = trim($email);
        if (!$email) {
            throw new \InvalidArgumentException('email');
        }

        Assertion::email($email);
        $this->email = strtolower($email);
    }

    /**
     * @param string $password
     */
    public function changePassword($password)
    {
        $password = trim($password);
        if (!$password) {
            throw new \InvalidArgumentException('password');
        }

        $this->password = $password;
    }

    /**
     * @return int
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

    /**
     * @return string
     */
    public function password()
    {
        return $this->password;
    }
}