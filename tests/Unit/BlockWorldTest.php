<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use BlockWorld\Library\BlockWorld;

final class BlockWorldTest extends TestCase
{
    public function testInstantiateBlockWorld(): void
    {
        $blockWorld = new BlockWorld();
    }
}