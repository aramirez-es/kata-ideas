<?php

namespace Kata\Ideas;


class IdeaId {
    private $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
