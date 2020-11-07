<?php

namespace App\Birds\Models;

class Egg
{
    private $hatchedBird;
    private $typeClass;

    public function __construct(string $typeClass)
    {
        $this->typeClass = $typeClass;
    }

    public function hatch(): Bird
    {
        if (!$this->hatchedBird instanceof Bird) {
            $this->hatchedBird = new $this->typeClass();
        }
        return $this->hatchedBird;
    }
}
