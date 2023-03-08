<?php

require __DIR__ . '/vendor/autoload.php';

use App\BlockWorld;

if (!isset($argv[1])) {
    echo "\r\n" . 'Warning: It is necessary to provide a .txt file with the correct input!' . "\r\n\r\n";
    exit;
}

$blockWorld = new BlockWorld();
echo 'Input: ' . "\r\n";
echo $blockWorld->printInput($argv[1]);
echo "\r\n\r\n" . 'Output: ' . "\r\n";
echo $blockWorld->readTxtFile($argv[1]);
