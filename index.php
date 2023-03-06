<?php

class BlockWorld 
{
    private int $n;
    private array $blocks = [];

    public function __construct(int $n)
    {
        $this->n = $n-1;

        for ($i=0; $i<=$this->n; $i++) {
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
            array_walk($this->blocks[$ind], ['BlockWorld', 'unsetAndReturnStackToInitialPositions'], ['a' => $a]);
            array_walk($this->blocks[$ind], ['BlockWorld', 'unsetAndReturnStackToInitialPositions'], ['b' => $b]);
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
            array_walk($this->blocks[$ind], ['BlockWorld', 'unsetAndReturnStackToInitialPositions'], ['a' => $a]);
        }

        unset($this->blocks[$a]['stack'][$a]);
        $this->blocks[$blockDestination]['stack'][$a] = $a;
    }

    public function pileOnto(int $a, int $b): void
    {
        if ($this->checkInconsistency($a, $b) === true) 
            return;

        $blockDestination = $this->retrieveBlockDestination($a, $b);
    }

    public function pileOver(int $a, int $b): void
    {
        if ($this->checkInconsistency($a, $b) === true) 
            return;

        $blockDestination = $this->retrieveBlockDestination($a, $b);

        foreach ($this->blocks as $ind => $block) {   
            array_walk($this->blocks[$ind], ['BlockWorld', 'unsetAndRelocateNewStack'], ['a' => $a, 'b' => $b]);
        }

        unset($this->blocks[$a]['stack'][$a]);
        $this->blocks[$blockDestination]['stack'][$a] = $a;
    }

    public function quit(): void
    {
        $results = [];

        echo '</br></br>';

        foreach( $this->blocks as $ind => $blocks )
        {
            foreach ($this->blocks[$ind] as $stacks) {
                echo $ind . ':';

                foreach ($stacks as $stack) {
                    echo ' ' . $stack;
                }
            }

            echo '<br/>';
        }
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

$blockWorld = new BlockWorld(10);
$blockWorld->moveOnto(9, 1);
$blockWorld->moveOver(8, 1);
$blockWorld->moveOver(7, 1);
$blockWorld->moveOver(6, 1);
$blockWorld->pileOver(8, 6);
$blockWorld->pileOver(8, 5);
$blockWorld->moveOver(2, 1);
$blockWorld->moveOver(4, 9);

echo '<pre>';
print_r($blockWorld->getBlocks());
$blockWorld->quit();
