<?php

namespace Kata\Ideas;

class Ideas
{
    private $ideas = [];

    public function add($idea)
    {
        $this->ideas[spl_object_hash($idea->getId())] = $idea;
    }

    public function get($idea_id)
    {
        return
            isset($this->ideas[spl_object_hash($idea_id)])
                ? $this->ideas[spl_object_hash($idea_id)]
                : null
        ;
    }
}
