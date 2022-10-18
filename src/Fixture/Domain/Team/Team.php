<?php

namespace Fixture\Domain\Team;

class Team
{
    private $id;
    private $name;
    private $flagImg;

    public function __construct(string $id, string $name, string $flagImg)
    {
        $this->id      = $id;
        $this->name    = $name;
        $this->flagImg = $flagImg;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFlagImg(): string
    {
        return $this->flagImg;
    }
}