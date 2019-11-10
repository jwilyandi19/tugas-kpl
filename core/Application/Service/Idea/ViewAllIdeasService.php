<?php

namespace TugasKPL\Application\Service\User;

use TugasKPL\Domain\Model\Idea\IdeaDoesNotExistException;

class ViewAllIdeasService extends IdeaService {
    public function execute() {
        $ideas = $this->IdeaRepository->all();
        if(!$ideas) {
            throw new IdeaDoesNotExistException();
        }

        return $ideas;
    }
}