<?php

require 'BlockWorld.php';

if (!isset($argv[1])) {
    echo "\r\n" . 'Warning: It is necessary to provide a .txt file with the correct input!' . "\r\n\r\n";
    exit;
}

// $blockWorld = new BlockWorld(10);
// $blockWorld->moveOnto(9, 1);
// $blockWorld->moveOver(8, 1);
// $blockWorld->moveOver(7, 1);
// $blockWorld->moveOver(6, 1);
// $blockWorld->pileOver(8, 6);
// $blockWorld->pileOver(8, 5);
// $blockWorld->moveOver(2, 1);
// $blockWorld->moveOver(4, 9);
// echo $blockWorld->quit();

$blockWorld = new BlockWorld();
echo 'Input: ' . "\r\n";
echo $blockWorld->printInput($argv[1], true);
echo "\r\n\r\n" . 'Output: ' . "\r\n";
echo $blockWorld->readTxtFile($argv[1], true);
