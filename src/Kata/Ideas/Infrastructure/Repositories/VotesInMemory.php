<?php

namespace Kata\Ideas\Infrastructure\Repositories;

use Kata\Ideas\Core\Repositories\Votes as VotesRepository;
use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Values\UserEmail;

class VotesInMemory implements VotesRepository
{
    private $votes = [];
    private $votes_by_user = [];

    public function add(IdeaId $idea_id, UserEmail $user)
    {
        $this->votes[$this->indexFor($idea_id)][] = $user;
        $this->votes_by_user[$this->indexFor($user)][] = $idea_id;
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
        return count($this->getFor($idea_id));
    }

    public function getForUser(UserEmail $user)
    {
        if (!isset($this->votes_by_user[$this->indexFor($user)])) {
            return 0;
        }
        return $this->votes_by_user[$this->indexFor($user)];
    }

    public function countForUser(UserEmail $user)
    {
        return count($this->getForUser($user));
    }

    private function indexFor($object)
    {
        return spl_object_hash($object);
    }

}
