<?php

namespace Kata\Ideas\Infrastructure\Repositories;

use Kata\Ideas\Core\Repositories\Votes as VotesRepository;
use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Values\UserEmail;

class VotesInMemory implements VotesRepository
{
    private $votes = [];

    public function add(IdeaId $idea_id, UserEmail $user)
    {
        $this->votes[$this->indexFor($idea_id)][] = $user;
    }

    public function getFor(IdeaId $idea_id)
    {
        if (!isset($this->votes[$this->indexFor($idea_id)])) {
            return [];
        }
        return $this->votes[$this->indexFor($idea_id)];
    }

    public function countFor(IdeaId $idea_id)
    {
        if (!isset($this->votes[$this->indexFor($idea_id)])) {
            return 0;
        }
        return count($this->votes[$this->indexFor($idea_id)]);
    }

    private function indexFor(IdeaId $idea_id)
    {
        return spl_object_hash($idea_id);
    }

}
