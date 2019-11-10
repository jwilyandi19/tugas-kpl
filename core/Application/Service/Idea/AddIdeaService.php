<?php

namespace TugasKPL\Application\Service\Idea;
use TugasKPL\Domain\Model\Idea\Idea;
use Tuupola\Ksuid;

class AddIdeaService extends IdeaService {
    /**
     * @param AddIdeaRequest $request
     * 
     * @return void
     */
    public function execute($request = null) {
        $content = $request->content();
        $description = $request->description();

        $id = new Ksuid;

        $idea = new Idea(
            $id,
            $content,
            $description
        );
        $this->ideaRepository->add($idea);
    }
}