<?php

namespace BlockWorld\Library;

class BlockWorld 
{
    private array $blocks = [];

    public function __construct(int $n = 0)
    {
        for ($i=0; $i<=$n-1; $i++) {
            $this->blocks[$i]['stack'][$i] = $i;
        }
    }

    public function moveOnto(int $a, int $b): void
    {
        if ($this->checkInconsistency($a, $b) === true) 
            return;

        if ($this->checkIfSameStack($a, $b)) 
            return;

        $blockDestination = $this->retrieveBlockDestination($a, $b);

        foreach ($this->blocks as $ind => $block) {   
            array_walk($this->blocks[$ind], ['BlockWorld\Library\BlockWorld', 'unsetAndReturnStackToInitialPositions'], ['a' => $a]);
            array_walk($this->blocks[$ind], ['BlockWorld\Library\BlockWorld', 'unsetAndReturnStackToInitialPositions'], ['b' => $b]);
        }

        unset($this->blocks[$a]['stack'][$a]);
        $this->blocks[$blockDestination]['stack'][$a] = $a;
    }

    public function moveOver(int $a, int $b): void
    {
        if ($this->checkInconsistency($a, $b) === true) 
            return;

        if ($this->checkIfSameStack($a, $b)) 
        return;

        $blockDestination = $this->retrieveBlockDestination($a, $b);

        foreach ($this->blocks as $ind => $block) {   
            array_walk($this->blocks[$ind], ['BlockWorld\Library\BlockWorld', 'unsetAndReturnStackToInitialPositions'], ['a' => $a]);
        }

        unset($this->blocks[$a]['stack'][$a]);
        $this->blocks[$blockDestination]['stack'][$a] = $a;
    }

    public function pileOnto(int $a, int $b): void
    {
        if ($this->checkInconsistency($a, $b) === true) 
            return;

        $blockDestination = $this->retrieveBlockDestination($a, $b);

        foreach ($this->blocks as $ind => $block) {
            array_walk($this->blocks[$ind], ['BlockWorld\Library\BlockWorld', 'unsetAndReturnStackToInitialPositions'], ['b' => $b]); 
        }

        foreach ($this->blocks as $ind => $block) {
            array_walk($this->blocks[$ind], ['BlockWorld\Library\BlockWorld', 'unsetAndRelocateNewStack'], ['a' => $a, 'b' => $b]);
        }

        unset($this->blocks[$a]['stack'][$a]);
        $this->blocks[$blockDestination]['stack'][$a] = $a;
    }

    public function pileOver(int $a, int $b): void
    {
        if ($this->checkInconsistency($a, $b) === true) 
            return;

        $blockDestination = $this->retrieveBlockDestination($a, $b);

        foreach ($this->blocks as $ind => $block) {
            array_walk($this->blocks[$ind], ['BlockWorld\Library\BlockWorld', 'unsetAndRelocateNewStack'], ['a' => $a, 'b' => $b]);
        }

        unset($this->blocks[$a]['stack'][$a]);
        $this->blocks[$blockDestination]['stack'][$a] = $a;
    }

    public function quit(): string
    {
        $result = '';

        foreach( $this->blocks as $ind => $blocks )
        {
            foreach ($this->blocks[$ind] as $stacks) {
                $result .= $ind . ':';

                foreach ($stacks as $stack) {
                    $result .= ' ' . $stack;
                }
            }

            $result .= "\r\n";
        }

        return trim($result);
    }

    public function readTxtFile(string $txtAddress): ?string
    {
        $i = 0;

        $fh = fopen($txtAddress,'r');
        while ($command = fgets($fh)) {
            
            if ($i === 0) {
                $blockWorld = new BlockWorld($command);
            } else {
                $commandArray = explode(' ', $command);

                $first = trim($commandArray[0]);
                if (isset($commandArray[1])) {
                    $a = trim($commandArray[1]);
                    $second = trim($commandArray[2]);
                    $b = trim($commandArray[3]);

                    if ($first === 'move' && $second === 'onto') {
                        $blockWorld->moveOnto($a, $b);
                    }

                    if ($first === 'move' && $second === 'over') {
                        $blockWorld->moveOver($a, $b);
                    }

                    if ($first === 'pile' && $second === 'onto') {
                        $blockWorld->pileOnto($a, $b);
                    }

                    if ($first === 'pile' && $second === 'over') {
                        $blockWorld->pileOver($a, $b);
                    }
                }

                if ($first === 'quit') {
                    return $blockWorld->quit();
                }
            }

            $i++;
        }
        fclose($fh);

        return null;
    }

    public function printInput(string $txtAddress): string
    {
        $text = '';
        $fh = fopen($txtAddress,'r');
        while ($line = fgets($fh)) {
            $text .= $line;
        }
        fclose($fh);

        return $text;
    }

    public function getBlocks(): array
    {
        return $this->blocks;
    }

    private function unsetAndReturnStackToInitialPositions(array &$items, string $key, array $params, bool &$active = false): void
    {
        foreach ($items as $ind => $item) {        
            if ($item === current($params)) {        
                unset($items[$ind]);
                $active = true;
            }
    
            if ($active === true) {
                unset($items[$ind]);
                $this->blocks[$item]['stack'][$item] = $item;
            }
        }
    }

    private function unsetAndRelocateNewStack(array &$items, string $key, array $params, bool &$active = false): void
    {
        foreach ($items as $ind => $item) {        
            if ($item === $params['a']) {        
                unset($items[$ind]);
                $active = true;
            }
    
            if ($active === true) {
                unset($items[$ind]);
                $this->blocks[$params['b']]['stack'][$item] = $item;
            }
        }
    }

    private function checkInconsistency(int $a, int $b): bool
    {
        if ($a === $b) {
            return true;
        }

        return false;
    }

    private function checkIfSameStack(int $a, int $b): bool 
    {
        $checkSameStack = [];

        foreach ($this->blocks as $blockId => $block) {
            $checkSameStack[$blockId] = array_key_exists($a, $block['stack']) && array_key_exists($b, $block['stack']);
        }

        return in_array(true, $checkSameStack) === true;
    }

    private function retrieveBlockDestination(int $a, int $b): int
    {
        if ($this->checkIfSameStack($a, $b) === true) {
            return $b;
        }

        foreach ($this->blocks as $blockId => $block) {
            $search[$blockId] = array_search($b, $block['stack']);
        }

        $removeBlank = array_filter($search);
        $blockDestination = key($removeBlank);

        return $blockDestination;
    }
}
