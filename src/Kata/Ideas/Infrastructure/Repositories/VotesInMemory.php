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

    public function findBy(IdeaId $idea_id)
    {
        if (!isset($this->votes[$this->indexFor($idea_id)])) {
            return [];
        }
        return $this->votes[$this->indexFor($idea_id)];
    }

    public function countBy(IdeaId $idea_id)
    {
        return count($this->findBy($idea_id));
    }

    public function findByUser(UserEmail $user)
    {
        if (!isset($this->votes_by_user[$this->indexFor($user)])) {
            return 0;
        }
        return $this->votes_by_user[$this->indexFor($user)];
    }

    public function countByUser(UserEmail $user)
    {
        return count($this->findByUser($user));
    }

    private function indexFor($object)
    {
        return spl_object_hash($object);
    }

}
