<?php

namespace TugasKPL\Infrastructure\Persistence\Sql;

use TugasKPL\Domain\Model\Idea\Idea;
use TugasKPL\Domain\Model\Idea\IdeaRepository;
use TugasKPL\Domain\Model\User\User;

class SqlIdeaRepository implements IdeaRepository {
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

    private function buildIdea($row) {
        return new Idea(
            $row['id'],
            $row['user_id'],
            $row['content'],
            $row['description'],
            $row['rating_score'],
            $row['rating_count']
        );
    }
 
    private function insert(Idea $idea) {
        $sql = 'INSERT INTO ideas (id,user_id,content,description) VALUES(:id, :user_id, :content, :description)';

        $this->execute($sql,[
            'id' => $idea->id(),
            'user_id' => $idea->userId(),
            'content' => $idea->content(),
            'description' => $idea->description()
        ]);
    }

    private function viewAll($sql, array $parameters = []) {
        $st = $this->pdo->prepare($sql);

        $st->execute($parameters);

        return array_map(function ($row) {
            return $this->buildIdea($row);

        }, $st->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function ofId($id) : Idea
    {
        $sql = 'SELECT * FROM ideas WHERE id = :id LIMIT 1';
        $st = $this->execute($sql, [
            'id' => $id
        ]);
        
        if($row = $st->fetch(\PDO::FETCH_ASSOC)) {
            return $this->buildIdea($row);
        }

        return null;
    }
    
    public function update($id, Idea $idea){
        $sql = 'UPDATE ideas SET 
            content = :content,
            description = :description,
            rating_score = :ratingScore,
            rating_count = :ratingCount
            WHERE id = :id';
        $this->execute($sql,[
            'id' => $id,
            'content' => $idea->content(),
            'description' => $idea->description(),
            'ratingScore' => $idea->ratingScore(),
            'ratingCount' => $idea->ratingCount()
        ]);
    }

    public function all() {
        $sql = "SELECT * FROM ideas";

        return $this->viewAll($sql,[]);
    }



    public function add(Idea $idea) {
        $this->insert($idea);
    }


}