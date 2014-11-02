<?php

namespace Kata\Ideas\Core\Values;


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

    function __toString()
    {
        return (string) $this->id;
    }


}
