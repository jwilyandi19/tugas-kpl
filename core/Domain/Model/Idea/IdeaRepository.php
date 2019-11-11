<?php

namespace TugasKPL\Domain\Model\Idea;

interface IdeaRepository {
    //public function ofId($ideaId);

    public function all();
    public function update($id, Idea $idea);
    public function ofId($id) : Idea;
    public function add(Idea $idea);
}