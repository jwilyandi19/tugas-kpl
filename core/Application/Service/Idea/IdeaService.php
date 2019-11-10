<?php

namespace TugasKPL\Application\Service\Idea;

use TugasKPL\Domain\Model\Idea\IdeaRepository;



abstract class IdeaService {
    protected $ideaRepository;

    public function __construct(IdeaRepository $ideaRepository) {
        $this->ideaRepository = $ideaRepository;
    }

    
}