<?php

namespace TugasKPL\Domain\Model\Idea;

interface IdeaRepository {
    public function ofId($ideaId);

    public function ofUserId($userId);

    public function all();

    public function add(Idea $idea);

    public function remove(Idea $idea);
}