<?php

namespace Kata\Ideas\Core\Repositories;

use Kata\Ideas\Core\Entities\Idea;
use Kata\Ideas\Core\Values\IdeaId;

interface Ideas
{
    public function add(Idea $idea);
    public function find(IdeaId $idea_id);
}
