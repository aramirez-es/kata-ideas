<?php

namespace Kata\Ideas\Core\Entities;

use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Values\UserEmail;

class Idea {
    private $id;
    private $text;
    private $owner;
    private $created_at;

    function __construct(IdeaId $id, $text, UserEmail $owner)
    {
        $this->id = $id;
        $this->text = $text;
        $this->owner = $owner;
        $this->created_at = time();
    }

    public function getId()
    {
        return $this->id;
    }

}
