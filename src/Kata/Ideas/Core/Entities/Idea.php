<?php

namespace Kata\Ideas\Core\Entities;

use Kata\Ideas\Core\Values\IdeaId;
use Kata\Ideas\Core\Values\UserEmail;

class Idea {
    private $id;
    private $text;
    private $owner;
    private $date;

    function __construct(IdeaId $id, $text, UserEmail $owner, $date)
    {
        $this->id = $id;
        $this->text = $text;
        $this->owner = $owner;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

}
