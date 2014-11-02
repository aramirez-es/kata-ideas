<?php

namespace Kata\Ideas\Core;

use Kata\Ideas\Core\Entities\Idea;
use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Repositories\Ideas;
use Kata\Ideas\Core\Repositories\Votes;

class Service
{
    private $ideas_repository;
    private $votes_repository;

    function __construct(Ideas $ideas_repository, Votes $votes_repository)
    {
        $this->ideas_repository = $ideas_repository;
        $this->votes_repository = $votes_repository;
    }

    public function suggest(Idea $idea)
    {
        $this->ideas_repository->add($idea);
    }

    public function get(IdeaId $idea_id)
    {
        return $this->ideas_repository->find($idea_id);
    }

    public function vote(IdeaId $idea_id, $user)
    {
        $this->votes_repository->add($idea_id, $user);
    }

    public function countVotesFor(IdeaId $idea_id)
    {
        if (!$this->ideas_repository->find($idea_id)) {
            throw new \InvalidArgumentException("Idea with ID: $idea_id does not exist.");
        }

        return $this->votes_repository->countFor($idea_id);
    }
}
