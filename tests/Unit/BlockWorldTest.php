<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use App\BlockWorld;
use PHPUnit\Framework\Attributes\DataProvider;

final class BlockWorldTest extends TestCase
{
    public function testBlockWorldQuit(): void
    {
        $blockWorld = new BlockWorld();
        $result = $blockWorld->quit();

        $this->assertSame('', $result);
    }

    public function testMoveOnto(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9, 1);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1 9\r\n2: 2\r\n3: 3\r\n4: 4\r\n5: 5\r\n6: 6\r\n7: 7\r\n8: 8\r\n9:";

        $this->assertSame($result, $compiled);
    }

    public function testMoveOntoWhenInconsistencyFound(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9, 1);
        $blockWorld->moveOnto(8, 8);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1 9\r\n2: 2\r\n3: 3\r\n4: 4\r\n5: 5\r\n6: 6\r\n7: 7\r\n8: 8\r\n9:";
        $this->assertSame($result, $compiled);
    }

    public function testBlockWorldWhenBlocksDifferentThanNull(): void
    {
        $blockWorld = new BlockWorld(10);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1\r\n2: 2\r\n3: 3\r\n4: 4\r\n5: 5\r\n6: 6\r\n7: 7\r\n8: 8\r\n9: 9";

        $this->assertSame($result, $compiled);
    }

    public function testMoveOntoWhenAAndBOnTheSameStack(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9, 1);
        $blockWorld->moveOver(8, 1);
        $blockWorld->moveOver(7, 1);
        $blockWorld->moveOnto(8, 7);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1 9 8 7\r\n2: 2\r\n3: 3\r\n4: 4\r\n5: 5\r\n6: 6\r\n7:\r\n8:\r\n9:";
        $this->assertSame($result, $compiled);
    }

    public function testMoveOverWhenInconsistencyFound(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9, 1);
        $blockWorld->moveOver(8, 1);
        $blockWorld->moveOver(8, 8);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1 9 8\r\n2: 2\r\n3: 3\r\n4: 4\r\n5: 5\r\n6: 6\r\n7: 7\r\n8:\r\n9:";

        $this->assertSame($result, $compiled);
    }

    public function testMoveOverWhenAAndBOnTheSameStack(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOver(9, 1);
        $blockWorld->moveOver(8, 1);
        $blockWorld->moveOver(7, 1);
        $blockWorld->moveOver(8, 7);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1 9 8 7\r\n2: 2\r\n3: 3\r\n4: 4\r\n5: 5\r\n6: 6\r\n7:\r\n8:\r\n9:";
        $this->assertSame($result, $compiled);
    }

    public function testMoveOver(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9, 1);
        $blockWorld->moveOver(8, 1);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1 9 8\r\n2: 2\r\n3: 3\r\n4: 4\r\n5: 5\r\n6: 6\r\n7: 7\r\n8:\r\n9:";

        $this->assertSame($result, $compiled);
    }

    public function testPileOverWhenInconsistencyFound(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9,1);
        $blockWorld->moveOver(8,1);
        $blockWorld->pileOver(9,4);
        $blockWorld->pileOver(9,9);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1\r\n2: 2\r\n3: 3\r\n4: 4 9 8\r\n5: 5\r\n6: 6\r\n7: 7\r\n8:\r\n9:";

        $this->assertSame($result, $compiled);
    }

    public function testPileOver(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9, 1);
        $blockWorld->moveOver(8, 1);
        $blockWorld->pileOver(9, 4);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1\r\n2: 2\r\n3: 3\r\n4: 4 9 8\r\n5: 5\r\n6: 6\r\n7: 7\r\n8:\r\n9:";

        $this->assertSame($result, $compiled);
    }

    public function testPileOntoWhenInconsistencyFound(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9, 1);
        $blockWorld->moveOver(2, 1);
        $blockWorld->moveOver(3, 7);
        $blockWorld->moveOver(8, 1);
        $blockWorld->pileOver(9, 4);
        $blockWorld->pileOnto(9, 1);
        $blockWorld->pileOnto(9, 7);
        $blockWorld->pileOnto(9, 9);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1\r\n2:\r\n3: 3\r\n4: 4\r\n5: 5\r\n6: 6\r\n7: 7 9 2 8\r\n8:\r\n9:";

        $this->assertSame($result, $compiled);
    }

    public function testPileOnto(): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9, 1);
        $blockWorld->moveOver(2, 1);
        $blockWorld->moveOver(3, 7);
        $blockWorld->moveOver(8, 1);
        $blockWorld->pileOver(9, 4);
        $blockWorld->pileOnto(9, 1);
        $blockWorld->pileOnto(9, 7);
        $compiled = $blockWorld->quit();

        $result = "0: 0\r\n1: 1\r\n2:\r\n3: 3\r\n4: 4\r\n5: 5\r\n6: 6\r\n7: 7 9 2 8\r\n8:\r\n9:";

        $this->assertSame($result, $compiled);
    }

    public function testReadTextFileWhenFileIsBlank(): void
    {
        $blockWorld = $this->createMock(BlockWorld::class);
        $blockWorld
                ->method('readTxtFile')
                ->with('input.txt')
                ->willReturn('');

        $this->assertSame('', $blockWorld->printInput('input.txt'));
    }

    public function testPrintingFile(): void
    {
        $blockWorld = $this->createMock(BlockWorld::class);
        $blockWorld
                ->method('printInput')
                ->with('input.txt')
                ->willReturn("10\nmove 9 onto 1\nmove 8 over 1\nmove 7 over 1\nmove 6 over 1\npile 8 over 6\npile 8 over 5\nmove 2 over 1\nmove 4 over 9\nquit");

        $input = "10\nmove 9 onto 1\nmove 8 over 1\nmove 7 over 1\nmove 6 over 1\npile 8 over 6\npile 8 over 5\nmove 2 over 1\nmove 4 over 9\nquit";

        $this->assertSame($input, $blockWorld->printInput('input.txt'));
    }

    public function testPrintingFilWhenFileIsBlank(): void
    {
        $blockWorld = $this->createMock(BlockWorld::class);
        $blockWorld
                ->method('printInput')
                ->with('input.txt')
                ->willReturn("");

        $input = "";

        $this->assertSame($input, $blockWorld->printInput('input.txt'));
    }

    public function testOutput(): void
    {
        $blockWorld = $this->createMock(BlockWorld::class);
        $blockWorld
                ->method('readTxtFile')
                ->with('input.txt')
                ->willReturn("0: 0\r\n1: 1 9 2 4\r\n2:\r\n3: 3\r\n4:\r\n5: 5 8 7 6\r\n6:\r\n7:\r\n8:\r\n9:");

        $output = "0: 0\r\n1: 1 9 2 4\r\n2:\r\n3: 3\r\n4:\r\n5: 5 8 7 6\r\n6:\r\n7:\r\n8:\r\n9:";

        $this->assertSame($output, $blockWorld->readTxtFile('input.txt'));
    }

    /**
     * @dataProvider blocksData
     */
    public function testGetBlocks(array $blocks): void
    {
        $blockWorld = new BlockWorld(10);
        $blockWorld->moveOnto(9, 1);

        $this->assertSame($blocks, $blockWorld->getBlocks());
    }

    public static function blocksData(): array
    {
        return [
                [
                    [
                        0 => [ 'stack' => [ 0 => 0 ]],
                        1 => [ 'stack' => [ 1 => 1, 9 => 9 ]],
                        2 => [ 'stack' => [ 2 => 2 ]],
                        3 => [ 'stack' => [ 3 => 3 ]],
                        4 => [ 'stack' => [ 4 => 4 ]],
                        5 => [ 'stack' => [ 5 => 5 ]],
                        6 => [ 'stack' => [ 6 => 6 ]],
                        7 => [ 'stack' => [ 7 => 7 ]],
                        8 => [ 'stack' => [ 8 => 8 ]],
                        9 => [ 'stack' => []],
                    ]
                ]
            ];
    }

    // public function testPrintingFile(): void
    // {
    //     $blockWorld = new BlockWorld();

    //     $input = "10\nmove 9 onto 1\nmove 8 over 1\nmove 7 over 1\nmove 6 over 1\npile 8 over 6\npile 8 over 5\nmove 2 over 1\nmove 4 over 9\nquit";

    //     $this->assertSame($input, $blockWorld->printInput('input.txt'));
    // }

    // public function testOutput(): void
    // {
    //     $blockWorld = new BlockWorld();

    //     $output = "0: 0\r\n1: 1 9 2 4\r\n2:\r\n3: 3\r\n4:\r\n5: 5 8 7 6\r\n6:\r\n7:\r\n8:\r\n9:";

    //     $this->assertSame($output, $blockWorld->readTxtFile('input.txt'));
    // }
}