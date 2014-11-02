<?php

namespace Kata\Ideas\Infrastructure\Repositories;

use Kata\Ideas\Core\Values\IdeaId;

class VotesInMemory
{
    private $votes = [];

    public function add(IdeaId $idea_id, $user)
    {
        $this->votes[$this->indexFor($idea_id)][] = $user;
    }

    public function countVotesFor(IdeaId $idea_id)
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
