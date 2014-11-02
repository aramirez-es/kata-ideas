<?php

namespace Kata\Ideas\Infrastructure\Repositories;

use Kata\Ideas\Core\Repositories\Ideas as IdeasRepository;
use Kata\Ideas\Core\Entities\Idea;
use Kata\Ideas\Core\Values\IdeaId;

class IdeasInMemory implements IdeasRepository
{
    private $ideas = [];

    public function add(Idea $idea)
    {
        $this->ideas[$this->indexFor($idea->getId())] = $idea;
    }

    public function find(IdeaId $idea_id)
    {
        return $this->ideaExists($idea_id)
            ? $this->getIdea($idea_id)
            : null;
    }

    private function indexFor(IdeaId $idea_id)
    {
        return spl_object_hash($idea_id);
    }

    private function ideaExists(IdeaId $idea_id)
    {
        return isset($this->ideas[$this->indexFor($idea_id)]);
    }

    private function getIdea(IdeaId $idea_id)
    {
        return $this->ideas[$this->indexFor($idea_id)];
    }

}
