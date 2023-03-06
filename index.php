<?php

require __DIR__ . '/vendor/autoload.php';

use BlockWorld\Library\BlockWorld;

$blockWorld = new BlockWorld(10);
$blockWorld->moveOnto(9, 1);
$blockWorld->moveOver(8, 1);
$blockWorld->moveOver(7, 1);
$blockWorld->moveOver(6, 1);
$blockWorld->pileOver(8, 6);
$blockWorld->pileOver(8, 5);
$blockWorld->moveOver(2, 1);
$blockWorld->moveOver(4, 9);
echo $blockWorld->quit();
