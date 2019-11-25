<?php

namespace App\Printing;

use App\Printing\Traits\HasNode;
use Illuminate\Support\Collection;

class Bin
{
    use HasNode;

    protected $width;

    protected $height;

    protected $free_space;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->free_space = new Collection();
    }

    /**
     * Get width.
     *
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * Get height.
     *
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     * Get free space in this bin.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFreeSpace(): Collection
    {
        return $this->free_space;
    }

    /**
     * Find free space in this bin.
     *
     * @param \App\Printing\Node $node
     * @return self
     */
    public function findFreeSpace(Node $node): self
    {
        if (! $node->isTaken()) {
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
