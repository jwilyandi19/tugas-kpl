<?php

namespace TugasKPL\Domain\Model\Idea;

class Idea {
    protected $ideaId;
    protected $content;
    protected $description;
    protected $userId;
    protected $ratingScore;
    protected $ratingCount;

    public function __construct($ideaId,$userId,$content,$description, $ratingScore = 0,$ratingCount = 0) {
        $this->ideaId = $ideaId;
        $this->userId = $userId;
        $this->setContent($content);
        $this->setDescription($description);
        $this->ratingScore = $ratingScore;
        $this->ratingCount = $ratingCount;
    }
    
    protected function setContent($content){
        if(!$content) {
            throw new \InvalidArgumentException('Judul ide tidak boleh kosong');
        }
        $this->content = $content;
    }

    protected function setDescription($description) {
        if(!$description) {
            throw new \InvalidArgumentException('Deskripsi tidak boleh kosong');
        }
        $this->description = $description;
    }

    public function updateRatingScore($newRatingScore){
        $this->ratingScore = $newRatingScore;
    }

    public function updateRatingCount($newRatingCount){
        $this->ratingCount = $newRatingCount;
    }

    public function id() {
        return $this->ideaId;
    }

    public function userId() {
        return $this->userId;
    }

    public function content() {
        return $this->content;
    }

    public function description() {
        return $this->description;
    }

    public function ratingScore(){
        return $this->ratingScore;
    }

    public function ratingCount(){
        return $this->ratingCount;
    }

}