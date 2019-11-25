<?php

namespace App\Printing;

class Node
{
    protected $x;

    protected $y;

    protected $width;

    protected $height;

    protected $taken;

    protected $right;

    protected $down;

    public function __construct(int $x, int $y, int $width, int $height, bool $taken = false, ?Node $right = null, ?Node $down = null)
    {
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
        $this->taken = $taken;
        $this->right = $right;
        $this->down = $down;
    }

    /**
     * Get x position
     *
     * @return int
     */
    public function x(): int
    {
        return $this->x;
    }

    /**
     * Get y position
     *
     * @return int
     */
    public function y(): int
    {
        return $this->y;
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
     * Set width
     *
     * @param int $width
     * @return self
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
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
     * Set height
     *
     * @param int $height
     * @return self
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Check if this item is taken
     *
     * @return bool
     */
    public function isTaken(): bool
    {
        return $this->taken;
    }

    /**
     * Set taken
     *
     * @param bool $taken
     * @return self
     */
    public function setTaken(bool $taken): self
    {
        $this->taken = $taken;

        return $this;
    }

    /**
     * Get right leaf node
     *
     * @return \App\Printing\Node|null
     */
    public function right(): ?Node
    {
        return $this->right;
    }

    /**
     * Set right leaf node
     *
     * @param \App\Printing\Node|null $right
     * @return self
     */
    public function setRight(?Node $right): self
    {
        $this->right = $right;

        return $this;
    }

    /**
     * Get down leaf node
     *
     * @return \App\Printing\Node|null
     */
    public function down(): ?Node
    {
        return $this->down;
    }

    /**
     * Set down leaf node
     *
     * @param \App\Printing\Node|null $down
     * @return self
     */
    public function setDown(?Node $down): self
    {
        $this->down = $down;

        return $this;
    }
}
