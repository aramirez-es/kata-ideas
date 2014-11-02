<?php

namespace Kata\Ideas\Core\Entities;


class Idea {
    private $id;
    private $text;
    private $owner;
    private $date;

    function __construct($id, $text, $owner, $date)
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
