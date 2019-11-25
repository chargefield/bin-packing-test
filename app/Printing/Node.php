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

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function width(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function height(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function isTaken(): bool
    {
        return $this->taken;
    }

    public function setTaken(bool $taken): self
    {
        $this->taken = $taken;

        return $this;
    }

    public function right(): ?Node
    {
        return $this->right;
    }

    public function setRight(?Node $right): self
    {
        $this->right = $right;

        return $this;
    }

    public function down(): ?Node
    {
        return $this->down;
    }

    public function setDown(?Node $down): self
    {
        $this->down = $down;

        return $this;
    }
}
