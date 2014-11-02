<?php

namespace Kata\Ideas;

class Ideas
{
    private $ideas = [];
    private $votes = [];

    public function add(Idea $idea)
    {
        $this->ideas[$this->indexFor($idea->getId())] = $idea;
        $this->votes[$this->indexFor($idea->getId())] = [];
    }

    public function get(IdeaId $idea_id)
    {
        return $this->ideaExists($idea_id)
            ? $this->getIdea($idea_id)
            : null
        ;
    }

    public function vote(IdeaId $idea_id, $user)
    {
        $this->votes[$this->indexFor($idea_id)][] = $user;
    }

    public function countVotesFor(IdeaId $idea_id)
    {
        if (!$this->ideaExists($idea_id)) {
            throw new \InvalidArgumentException("Idea with ID: $idea_id does not exist.");
        }

        return count($this->votes[$this->indexFor($idea_id)]);
    }

    private function ideaExists(IdeaId $idea_id)
    {
        return isset($this->ideas[$this->indexFor($idea_id)]);
    }

    private function getIdea(IdeaId $idea_id)
    {
        return $this->ideas[$this->indexFor($idea_id)];
    }

    private function indexFor(IdeaId $idea_id)
    {
        return spl_object_hash($idea_id);
    }
}
