<?php

namespace App\Printing;

use App\Product;
use App\OrderItem;

class Item
{
    protected $product;
    protected $order_item;
    protected $width;
    protected $height;
    protected $node;

    public function __construct(Product $product, OrderItem $order_item)
    {
        $this->product = $product;
        $this->order_item = $order_item;
        $this->width = $this->product->width();
        $this->height = $this->product->height();
    }

    public function width()
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function height()
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function orderItem(): OrderItem
    {
        return $this->order_item;
    }

    public function rotate(): self
    {
        if ($this->width !== $this->height) {
            $width = $this->width;

            $this->setWidth($this->height)->setHeight($width);
        }

        return $this;
    }

    public function isRotated(): bool
    {
        return $this->width !== $this->product->width();
    }

    public function overflow(): bool
    {
        return (bool) is_null($this->node);
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
}
