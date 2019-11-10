<?php

namespace TugasKPL\Application\Service\Idea;

class AddIdeaRequest {
    private $userId;
    private $email;
    private $content;
    private $description;

    public function __construct($userId,$email,$content,$description) {
        $this->content = $content;
        $this->userId = $userId;
        $this->email = $email;
        $this->description = $description;
    }

    public function userId() {
        return $this->userId;
    }

    public function email() {
        return $this->email;
    }

    public function content() {
        return $this->content;
    }

    public function description() {
        return $this->description;
    }
}