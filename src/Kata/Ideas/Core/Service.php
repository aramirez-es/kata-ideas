<?php

namespace Kata\Ideas\Core;

use Kata\Ideas\Core\Entities\Idea;
use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Repositories\Ideas;
use Kata\Ideas\Core\Repositories\Votes;
use Kata\Ideas\Core\Values\UserEmail;

class Service
{
    private $ideas_repository;
    private $votes_repository;
    private $logged_in_user;

    function __construct(Ideas $ideas_repository, Votes $votes_repository, UserEmail $logged_user)
    {
        $this->ideas_repository = $ideas_repository;
        $this->votes_repository = $votes_repository;
        $this->logged_in_user = $logged_user;
    }

    public function suggest(Idea $idea)
    {
        $this->ideas_repository->add($idea);
    }

    public function get(IdeaId $idea_id)
    {
        return $this->ideas_repository->find($idea_id);
    }

    public function vote(IdeaId $idea_id, UserEmail $user)
    {
        $this->guardIdeaExists($idea_id);
        $this->guardEmployeesVotingTheirIdeas($idea_id);

        $this->votes_repository->add($idea_id, $user);
    }

    public function countVotesFor(IdeaId $idea_id)
    {
        $this->guardIdeaExists($idea_id);

        return $this->votes_repository->countFor($idea_id);
    }

    private function guardIdeaExists(IdeaId $idea_id)
    {
        if (!$this->ideas_repository->find($idea_id)) {
            throw new \InvalidArgumentException("Idea with ID: $idea_id does not exist.");
        }
    }

    private function guardEmployeesVotingTheirIdeas(IdeaId $idea_id)
    {
        if ($this->ideas_repository->find($idea_id)->isOwner($this->logged_in_user)) {
            throw new \DomainException("Employees can't vote their own ideas.");
        }
    }
}
