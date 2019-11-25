<?php

namespace App\Printing;

use App\Printing\Traits\HasNode;
use Illuminate\Support\Collection;

class Bin
{
    use HasNode;

    protected $width;

    protected $height;

    protected $items;

    protected $callback;

    protected $products;

    protected $overflow;

    protected $free_space;

    public function __construct(int $width, int $height, Collection $items, ?callable $callback = null)
    {
        $this->width = $width;
        $this->height = $height;
        $this->items = $items;
        $this->callback = $callback;
        $this->free_space = new Collection();

        $this->pack();
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
     * Get items.
     *
     * @return \Illuminate\Support\Collection
     */
    public function items(): Collection
    {
        return $this->items;
    }

    /**
     * Add an item to this bin.
     *
     * @param \App\Printing\Item $item
     * @return self
     */
    public function addItem(Item $item): self
    {
        $this->items->push($item);

        $this->pack();

        return $this;
    }

    /**
     * Get all unique products used in this bin.
     *
     * @return \Illuminate\Support\Collection
     */
    public function products(): Collection
    {
        if (is_null($this->products)) {
            $this->products = $this->items
                ->map->product()
                ->unique->id
                ->sortBy('title')
                ->values();
        }

        return $this->products;
    }

    /**
     * Get all the products that could not fit in this bin.
     *
     * @return \Illuminate\Support\Collection
     */
    public function overflow(): Collection
    {
        if (is_null($this->overflow)) {
            $this->overflow = $this->items
                ->filter->overflow()
                ->values();
        }

        return $this->overflow;
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
    protected function findFreeSpace(Node $node): self
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

    /**
     * Pack this bin.
     *
     * @return \Illuminate\Support\Collection
     */
    public function pack(): Collection
    {
        $this->products = null;
        $this->overflow = null;

        $base = new Node(0, 0, $this->width(), $this->height());

        $this->setNode($base);

        $items = $this->items
            ->sortByDesc->height()
            ->values()
            ->map(function (Item $item) {
                $node = $this->getNode($this->node(), $item);

                if (! is_null($node)) {
                    $item->setNode($this->createLeafNodes($node, $item->width(), $item->height()));
                }

                if (! is_null($this->callback)) {
                    $this->callback($this, $this->items, $item);
                }

                return $item;
            });

        $this->findFreeSpace($this->node());

        return $items;
    }

    /**
     * Get node.
     *
     * @param \App\Printing\Node $base
     * @param \App\Printing\Item $item
     * @return \App\Printing\Node|null
     */
    protected function getNode(Node $base, Item $item): ?Node
    {
        $node = $this->findNode($base, $item->width(), $item->height());
        if (is_null($node)) {
            $item->rotate();

            $node = $this->findNode($base, $item->width(), $item->height());
            if (is_null($node)) {
                $item->rotate();
            }
        }

        return $node;
    }

    /**
     * Find node.
     *
     * @param \App\Printing\Node $node
     * @param int $width
     * @param int $height
     * @return \App\Printing\Node|null
     */
    protected function findNode(Node $node, int $width, int $height): ?Node
    {
        if ($node->isTaken()) {
            if ($right_leaf_node = $this->findNode($node->right(), $width, $height)) {
                return $right_leaf_node;
            }

            return $this->findNode($node->down(), $width, $height);
        } elseif ($width <= $node->width() && $height <= $node->height()) {
            return $node;
        }

        return null;
    }

    /**
     * Create a set of leaf nodes.
     *
     * @param \App\Printing\Node $node
     * @param int $width
     * @param int $height
     * @return \App\Printing\Node
     */
    protected function createLeafNodes(Node $node, int $width, int $height): Node
    {
        $node->setTaken(true);
        $node->setDown(new Node($node->x(), $node->y() + $height, $node->width(), $node->height() - $height));
        $node->setRight(new Node($node->x() + $width, $node->y(), $node->width() - $width, $height));
        $node->setWidth($width);
        $node->setHeight($height);

        return $node;
    }
}
