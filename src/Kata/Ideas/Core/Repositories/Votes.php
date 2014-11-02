<?php

namespace Kata\Ideas\Core\Repositories;

use Kata\Ideas\Core\Values\IdeaId;

interface Votes
{
    public function add(IdeaId $idea_id, $user);
    public function countFor(IdeaId $idea_id);
}
