<?php

namespace Kata\Ideas\Core;

use Kata\Ideas\Core\Entities\Idea;
use Kata\Ideas\Core\Values\IdeaId;

use Kata\Ideas\Infrastructure\Repositories\IdeasInMemory;
use Kata\Ideas\Infrastructure\Repositories\VotesInMemory;

class Service
{
    private $ideas_repository;
    private $votes_repository;

    function __construct()
    {
        $this->ideas_repository = new IdeasInMemory();
        $this->votes_repository = new VotesInMemory();
    }

    public function add(Idea $idea)
    {
        $this->ideas_repository->add($idea);
    }

    public function get(IdeaId $idea_id)
    {
        return $this->ideas_repository->get($idea_id);
    }

    public function vote(IdeaId $idea_id, $user)
    {
        $this->votes_repository->add($idea_id, $user);
    }

    public function countVotesFor(IdeaId $idea_id)
    {
        if (!$this->ideas_repository->get($idea_id)) {
            throw new \InvalidArgumentException("Idea with ID: $idea_id does not exist.");
        }

        return $this->votes_repository->countVotesFor($idea_id);
    }

    private function indexFor(IdeaId $idea_id)
    {
        return spl_object_hash($idea_id);
    }
}
