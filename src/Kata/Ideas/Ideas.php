<?php

namespace Kata\Ideas;

class Ideas
{
    private $ideas = [];

    public function add($idea)
    {
        $this->ideas[$idea->getId()] = $idea;
    }

    public function get($idea_id)
    {
        return isset($this->ideas[$idea_id]) ? $this->ideas[$idea_id] : null;
    }
}
