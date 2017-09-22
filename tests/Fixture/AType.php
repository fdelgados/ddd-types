<?php

namespace Tests\Types\Fixture;

class AType
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function name()
    {
        return $this->name;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }
}
