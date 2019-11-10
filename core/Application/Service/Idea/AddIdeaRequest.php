<?php

namespace TugasKPL\Application\Service\Idea;

class AddIdeaRequest {
    private $content;
    private $description;

    public function __construct($content,$description) {
        $this->content = $content;
        $this->description = $description;
    }

    public function content() {
        return $this->content;
    }

    public function description() {
        return $this->description;
    }
}