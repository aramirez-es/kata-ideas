<?php

namespace spec\Kata\Ideas;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Kata\Ideas\Idea;

class IdeasSpec extends ObjectBehavior
{
    function it_should_add_a_new_idea()
    {
        $idea_id = 231;
        $idea = new Idea($idea_id, "idea text", "user@domain.com", time());
        $this->add($idea);
        $this->get($idea_id)->shouldReturn($idea);
    }

    function it_should_return_null_if_idea_does_not_exist()
    {
        $this->get(999)->shouldReturn(null);
    }
}
