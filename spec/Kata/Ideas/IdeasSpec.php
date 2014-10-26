<?php

namespace spec\Kata\Ideas;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IdeasSpec extends ObjectBehavior
{
    function it_should_add_a_new_idea()
    {
        $idea = ["user@domain.com", "idea text", time()];
        $idea_id = $this->add($idea[0], $idea[1], $idea[2]);
        $this->get($idea_id)->shouldReturn($idea);
    }
}
