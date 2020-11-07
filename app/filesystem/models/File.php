<?php

namespace App\Filesystem\Models;

class File
{
    public $name = '';
    public $parent = null;

    public function __construct(string $name, $parent = null)
    {
        $this->name = $name;
        $this->parent = $parent;
    }
}
