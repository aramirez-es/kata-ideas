<?php

namespace Kata\Ideas\Core\Values;

class UserEmail
{
    private $email;

    function __construct($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    function __toString()
    {
        return (string) $this->email;
    }
}
