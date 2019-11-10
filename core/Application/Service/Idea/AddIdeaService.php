<?php

namespace TugasKPL\Application\Service\Idea;
use TugasKPL\Domain\Model\User\UserDoesNotExistException;
use Tuupola\Ksuid;

class AddIdeaService extends IdeaService {
    /**
     * @param AddIdeaRequest $request
     * 
     * @return void
     */
    public function execute($request = null) {
        $userId = $request->userId();
        $content = $request->content();
        $description = $request->description();

        $user = $this->findUserOrFail($userId);

        $ideaId = new Ksuid;

        $idea = $user->makeIdea(
            $ideaId,
            $content,
            $description
        );
        
        $this->ideaRepository->add($idea);
    }
}