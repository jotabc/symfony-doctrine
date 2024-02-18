<?php

namespace App\Entity;

class User
{
    private int $id = null;

    private string $name = null;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

}
