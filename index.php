<?php

require 'vendor/autoload.php';

use App\Filesystem\FileSystem;

/******** QUESTION 1 ********/
$f = new FileSystem();
$f->addDirectory('directoryA', null);
$f->addFile('fileA.jpg', 'directoryA');
$f->addDirectory('directoryB', 'directoryA');
$f->addFile('fileB.txt', 'directoryB');
$f->addFile('fileC.txt', 'directoryB');
$f->addDirectory('directoryC', 'directoryB');
$f->addFile('fileD.jpg', 'directoryC');
echo implode(', ', $f->getItems('directoryA'));
$f->deleteSubdirectory('directoryB');
$f->deleteFile('directoryA', 'fileA.jpg');


/******** QUESTION 2 ********/
/*
Bird -> chickens
Birds lay eggs -> new Egg
EggTypes -> ChickenEgg, turkeyEgg
Egg -> hatch() -> new BirdType
*/
