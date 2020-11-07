<?php

require 'vendor/autoload.php';

use App\Birds\Chicken;
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
dump(implode(', ', $f->getItems('directoryA')));
$f->deleteSubdirectory('directoryB');
$f->deleteFile('directoryA', 'fileA.jpg');


/******** QUESTION 2 ********/
$chicken = new Chicken();
$egg = $chicken->layEgg();
dump($egg);
$bird = $egg->hatch();
dump($bird);


/******** QUESTION 3 ********/
function shiftLetters(string $str, array $shifts)
{
    $strArr = str_split($str);
    foreach ($shifts as $shift) {
        $direction = $shift[0];
        $shiftTimes = $shift[1];
        while ($shiftTimes > 0) {
            if ($direction === 0) {
                // move left
                $letter = array_shift($strArr);
                $strArr[] = $letter;
            } else {
                // move  right
                $letter = array_pop($strArr);
                array_unshift($strArr, $letter);
            }
            $shiftTimes--;
        }
    }
    return implode('', $strArr);
}
$str = "abcdefg";
$shifts = [[1,1],[1,1],[0,2],[1,3]];
$result = shiftLetters($str, $shifts);
dump($result);
