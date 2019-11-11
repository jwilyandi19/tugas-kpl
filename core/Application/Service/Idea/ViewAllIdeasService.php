<?php

namespace TugasKPL\Application\Service\Idea;

use TugasKPL\Domain\Model\Idea\IdeaDoesNotExistException;

class ViewAllIdeasService extends IdeaService {
    public function execute() {
        $ideas = $this->ideaRepository->all();
        if(!$ideas) {
            throw new IdeaDoesNotExistException();
        }

        return $ideas;
    }
}