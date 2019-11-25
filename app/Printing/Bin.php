<?php

namespace App\Printing;

use Illuminate\Support\Collection;

class Bin
{
    protected $width;
    protected $height;
    protected $node;
    protected $free_space;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->free_space = new Collection();
    }

    public function width(): int
    {
        return $this->width;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function node(): ?Node
    {
        return $this->node;
    }

    public function setNode(?Node $node): self
    {
        $this->node = $node;

        return $this;
    }

    public function getFreeSpace(): Collection
    {
        return $this->free_space;
    }

    public function findFreeSpace(Node $node): self
    {
        if (!$node->isTaken()) {
            $this->free_space->push([$node->x(), $node->y(), $node->width(), $node->height()]);
        }

        if ($right = $node->right()) {
            $this->findFreeSpace($right);
        }

        if ($down = $node->down()) {
            $this->findFreeSpace($down);
        }

        return $this;
    }
}
