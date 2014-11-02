<?php

namespace Kata\Ideas\Core;

use Kata\Ideas\Core\Entities\Idea;
use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Repositories\Ideas;
use Kata\Ideas\Core\Repositories\Votes;
use Kata\Ideas\Core\Values\UserEmail;

class Service
{
    const MAX_VOTES_BY_USER = 3;

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

    public function vote(IdeaId $idea_id, UserEmail $user)
    {
        $this->guardIdeaExists($idea_id);
        $this->guardEmployeesVotingTheirIdeas($idea_id, $user);
        $this->guardEmployeesVotingTwiceTheSameIdea($idea_id, $user);
        $this->guardEmployeesVotingLimitQuote($user);

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

    private function guardEmployeesVotingTheirIdeas(IdeaId $idea_id, UserEmail $user_id)
    {
        if ($this->ideas_repository->find($idea_id)->isOwner($user_id)) {
            throw new \DomainException("Employees can't vote their own ideas.");
        }
    }

    private function guardEmployeesVotingTwiceTheSameIdea(IdeaId $idea_id, UserEmail $user)
    {
        if (in_array($user, $this->votes_repository->getFor($idea_id))) {
            throw new \DomainException("User $user already voted Idea $idea_id.");
        }
    }

    private function guardEmployeesVotingLimitQuote(UserEmail $user)
    {
        if ($this->votes_repository->countForUser($user) === self::MAX_VOTES_BY_USER) {
            throw new \DomainException("Employees can't vote more than three ideas.");
        }
    }
}
