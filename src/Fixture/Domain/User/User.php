<?php

namespace Fixture\Domain\User;

class User
{
    private $id;
    private $name;
    private $email;

    public function __construct(?int $id, string $name, string $email)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->email  = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }
}