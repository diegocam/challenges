<?php

namespace App\Birds\Models;

abstract class Bird
{
    abstract public function layEgg(): Egg;
}
