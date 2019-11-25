<?php

namespace App\Printing;

use App\Product;
use App\OrderItem;
use App\Printing\Traits\HasNode;

class Item
{
    use HasNode;

    protected $product;

    protected $order_item;

    protected $width;

    protected $height;

    public function __construct(Product $product, OrderItem $order_item)
    {
        $this->product = $product;
        $this->order_item = $order_item;
        $this->width = $this->product->width();
        $this->height = $this->product->height();
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
     * Get product model
     *
     * @return \App\Product
     */
    public function product(): Product
    {
        return $this->product;
    }

    /**
     * Get order item model
     *
     * @return \App\OrderItem
     */
    public function orderItem(): OrderItem
    {
        return $this->order_item;
    }

    /**
     * Rotate this item
     *
     * @return self
     */
    public function rotate(): self
    {
        if ($this->width !== $this->height) {
            $width = $this->width;

            $this->setWidth($this->height)->setHeight($width);
        }

        return $this;
    }

    /**
     * Check if this item is rotated
     *
     * @return bool
     */
    public function isRotated(): bool
    {
        return $this->width !== $this->product->width();
    }

    /**
     * Check if this item is not in a bin
     *
     * @return bool
     */
    public function overflow(): bool
    {
        return (bool) is_null($this->node);
    }
}
