<?php

namespace Kata\Ideas;

class Ideas
{
    private $ideas = [];

    public function add($user, $idea_text, $idea_date)
    {
        $this->ideas[] = [$user, $idea_text, $idea_date];
        return (count($this->ideas) - 1);
    }

    public function get($idea_id)
    {
        return $this->ideas[$idea_id];
    }
}
