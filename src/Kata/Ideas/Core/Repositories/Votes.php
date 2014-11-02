<?php

namespace Kata\Ideas\Core\Repositories;

use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Values\UserEmail;

interface Votes
{
    public function add(IdeaId $idea_id, UserEmail $user);
    public function getFor(IdeaId $idea_id);
    public function countFor(IdeaId $idea_id);
    public function getForUser(UserEmail $user);
    public function countForUser(UserEmail $user);
}
