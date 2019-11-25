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

    /**
     * Get width
     *
     * @return int
     */
    public function width(): int
    {
        return $this->width;
    }

    /**
     * Get height
     *
     * @return int
     */
    public function height(): int
    {
        return $this->height;
    }

    /**
     * Get node
     *
     * @return \App\Printing\Node|null
     */
    public function node(): ?Node
    {
        return $this->node;
    }

    /**
     * Set node
     *
     * @param \App\Printing\Node|null $node
     * @return self
     */
    public function setNode(?Node $node): self
    {
        $this->node = $node;

        return $this;
    }

    /**
     * Get free space in this bin
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFreeSpace(): Collection
    {
        return $this->free_space;
    }

    /**
     * Find free space in this bin
     *
     * @param \App\Printing\Node $node
     * @return self
     */
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
