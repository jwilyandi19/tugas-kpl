<?php
namespace TugasKPL\Domain\Model\User;

use TugasKPL\Domain\Model\Idea\Idea;

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
     * @param string $userId
     * @param string $email
     * @param string $password
     */
    public function __construct($userId, $email, $password)
    {
        $this->userId = $userId;
        $this->setEmail($email);
        $this->changePassword($password);
        $this->ideas = [];
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
    /**
     * @return string
     */
    public function password()
    {
        return $this->password;
    }

    public function makeIdea($ideaId, $content, $description) {
        return new Idea(
            $ideaId,
            $this->userId,
            $content,
            $description
        );
    }

    /**
     * @return array
     */
    public function ideas()
    {
        return $this->ideas;
    }
}