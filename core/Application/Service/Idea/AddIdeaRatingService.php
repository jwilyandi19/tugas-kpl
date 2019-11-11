<?php

namespace TugasKPL\Application\Service\Idea;

use TugasKPL\Domain\Model\User\UserDoesNotExistException;
use Tuupola\Ksuid;

class AddIdeaRatingService extends IdeaService {
    /**
     * @param String $id
     * 
     * @param Int $ratingScore
     * 
     * @return void
     */
    public function execute($id, $ratingScore) {
        $idea = $this->ideaRepository->ofId($id);
        $newScore = $this->calculateNewRatingScore($ratingScore, $idea->ratingScore(), $idea->ratingCount());
        $idea->updateRatingScore($newScore);
        $idea->updateRatingCount($idea->ratingCount() + 1);
        $this->ideaRepository->update($id, $idea);
    }

    private function calculateNewRatingScore($addedRatingScore, $savedRatingScore, $savedRatingCount){
        $newScore = ($savedRatingScore * $savedRatingCount + $addedRatingScore) / ($savedRatingCount+1);
        return $newScore;
    }
}