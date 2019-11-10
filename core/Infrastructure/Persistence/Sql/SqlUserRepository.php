<?php

namespace TugasKPL\Infrastructure\Persistence\Sql;

use TugasKPL\Domain\Model\User\User;
use TugasKPL\Domain\Model\User\UserRepository;

class SqlUserRepository implements UserRepository
{
    private $pdo;
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Helper functions
    private function execute($sql, array $parameters)
    {
        $st = $this->pdo->prepare($sql);

        $st->execute($parameters);

        return $st;
    }

    private function buildUser($row)
    {
        return new User(
            $row['id'],
            $row['email'],
            $row['password']
        );
    }

    private function insert(User $user)
    {
        $sql = 'INSERT INTO users (id, email, password)
        VALUES (:id, :email, :password)';

        $this->execute($sql, [
            'id' => $user->id(),
            'email' => $user->email(),
            'password' => $user->password()
        ]);
    }

    // Implementations
    public function ofId($userId)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $st = $this->execute($sql, [
            'id' => $userId
        ]);

        if($row = $st->fetch(\PDO::FETCH_ASSOC)) {
            return $this->buildUser($row);
        }

        return null;
    }

    public function ofEmail($email)
    {
        $st = $this->execute(
            'SELECT * FROM users WHERE email = :email', 
            ['email' => $email]
        );

        if($row = $st->fetch(\PDO::FETCH_ASSOC)) {
            return $this->buildUser($row);
        }

        return null;
    }

    public function add(User $user)
    {
        $this->insert($user);
    }
}