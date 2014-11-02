<?php

namespace spec\Kata\Ideas\Core;

use Kata\Ideas\Core\Values\UserEmail;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Kata\Ideas\Infrastructure\Repositories\IdeasInMemory;
use Kata\Ideas\Infrastructure\Repositories\VotesInMemory;

use Kata\Ideas\Core\Entities\Idea;
use Kata\Ideas\Core\Values\IdeaId;

class ServiceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            new IdeasInMemory(),
            new VotesInMemory(),
            new UserEmail("logged@user.com")
        );
    }

    function it_should_suggest_a_new_idea()
    {
        $idea_id = new IdeaId(231);
        $user_id = new UserEmail("any@user.com");

        $idea = new Idea($idea_id, "idea text", $user_id);

        $this->suggest($idea);
        $this->get($idea_id)->shouldReturn($idea);
    }

    function it_should_return_null_if_idea_does_not_exist()
    {
        $this->get(new IdeaId(999))->shouldReturn(null);
    }

    function it_should_be_able_to_vote_ideas()
    {
        $idea_id = new IdeaId(uniqid());
        $user_id = new UserEmail("any@user.com");

        $idea = new Idea($idea_id, "any text", $user_id);

        $this->suggest($idea);
        $this->vote($idea_id, $user_id);
        $this->countVotesFor($idea_id)->shouldReturn(1);
    }

    function it_should_return_zero_when_idea_did_not_get_any_vote()
    {
        $idea_id = new IdeaId(uniqid());
        $user_id = new UserEmail("any@user.com");

        $idea = new Idea($idea_id, "any text", $user_id);

        $this->suggest($idea);
        $this->countVotesFor($idea_id)->shouldReturn(0);
    }

    function it_should_throw_exception_if_idea_does_not_exist()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringCountVotesFor(new IdeaId(uniqid()));
    }

    function it_should_not_be_able_to_vote_an_unexistent_idea()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringVote(new IdeaId(uniqid()), new UserEmail("any@user.com"));
    }

    function it_should_not_be_able_to_vote_its_own_ideas()
    {
        $idea_id = new IdeaId(uniqid());
        $user_id = new UserEmail("logged@user.com");

        $idea = new Idea($idea_id, "any text", $user_id);
        $this->suggest($idea);

        $this->shouldThrow('\DomainException')->duringVote($idea_id, $user_id);
    }

    function it_should_not_be_able_to_vote_twice_the_same_idea()
    {
        $idea_id = new IdeaId(uniqid());
        $user_id = new UserEmail("any@user.com");
        $idea = new Idea($idea_id, "any text", $user_id);

        $ideas_repo = new IdeasInMemory();
        $votes_repo = new VotesInMemory();

        $ideas_repo->add($idea);
        $votes_repo->add($idea_id, $user_id);

        $this->beConstructedWith($ideas_repo, $votes_repo, new UserEmail("logged@user.com"));

        $this->shouldThrow('\DomainException')->duringVote($idea_id, $user_id);
    }
}
