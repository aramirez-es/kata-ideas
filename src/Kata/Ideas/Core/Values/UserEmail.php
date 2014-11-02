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

    public function equalsTo(UserEmail $other)
    {
        return $this->getEmail() === $other->getEmail();
    }

    function __toString()
    {
        return (string) $this->email;
    }
}
