<?php

namespace Kata\Ideas;

class Ideas
{
    private $ideas = [];
    private $votes = [];

    public function add(Idea $idea)
    {
        $this->ideas[spl_object_hash($idea->getId())] = $idea;
        $this->votes[spl_object_hash($idea->getId())] = [];
    }

    public function get(IdeaId $idea_id)
    {
        return
            isset($this->ideas[spl_object_hash($idea_id)])
                ? $this->ideas[spl_object_hash($idea_id)]
                : null
        ;
    }

    public function vote(IdeaId $idea_id, $user)
    {
        $this->votes[spl_object_hash($idea_id)][] = $user;
    }

    public function countVotesFor(IdeaId $idea_id)
    {
        if (!isset($this->votes[spl_object_hash($idea_id)])) {
            throw new \InvalidArgumentException("Idea with ID: $idea_id does not exist.");
        }

        return count($this->votes[spl_object_hash($idea_id)]);
    }
}
