<?php

namespace App;

interface BlockWorldInterface 
{
    public function moveOnto(int $a, int $b): void;
    public function moveOver(int $a, int $b): void;
    public function pileOnto(int $a, int $b): void;
    public function pileOver(int $a, int $b): void;
    public function quit(): string;
    public function readTxtFile(string $txtAddress): string;
    public function printInput(string $txtAddress): string;
}