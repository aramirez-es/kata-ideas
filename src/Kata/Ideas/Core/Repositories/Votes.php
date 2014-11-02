<?php

namespace Kata\Ideas\Core\Repositories;

use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Values\UserEmail;

interface Votes
{
    public function add(IdeaId $idea_id, UserEmail $user);
    public function countFor(IdeaId $idea_id);
}
