<?php

namespace App\Filesystem\Models;

class Directory
{
    public $name = '';
    public $parent = null;
    public $children = [];

    public function __construct(string $name, $parent = null)
    {
        $this->name = $name;
        $this->parent = $parent;
    }
}
