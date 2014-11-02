<?php

namespace Kata\Ideas\Core\Repositories;

use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Values\UserEmail;

interface Votes
{
    public function add(IdeaId $idea_id, UserEmail $user);
    public function findBy(IdeaId $idea_id);
    public function countBy(IdeaId $idea_id);
    public function findByUser(UserEmail $user);
    public function countByUser(UserEmail $user);
}
