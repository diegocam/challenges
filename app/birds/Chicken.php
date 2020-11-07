<?php

namespace App\Birds;

use App\Birds\Models\Bird;
use App\Birds\Models\Egg;

class Chicken extends Bird
{
    public function layEgg(): Egg
    {
        return new Egg(__CLASS__);
    }
}
