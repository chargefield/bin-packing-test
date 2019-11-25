<?php

namespace App\Printing;

use Illuminate\Support\Collection;

class Bins
{
    protected $bins;

    public function __construct()
    {
        $this->bins = new Collection();
    }

    public function add(int $width, int $height, Collection $items): self
    {
        $this->bins->push([
            'bin' => new Bin($width, $height),
            'items' => $items,
            'products' => $items->map->product()->unique->id->sortBy('title')->values(),
        ]);

        return $this;
    }

    public function create(): Collection
    {
        return $this->bins->map(function (array $bin) {
            return [
                'bin' => $bin['bin'],
                'items' => $this->pack($bin['bin'], $bin['items']),
                'overflow' => ($bin['items'])->filter->overflow()->values(),
                'products' => $bin['products'],
            ];
        });
    }

    public function pack(Bin $bin, Collection $items, ?callable $callback = null): Collection
    {
        $base = new Node(0, 0, $bin->width(), $bin->height());

        $bin->setNode($base);

        $items = $items->sortByDesc
            ->height()
            ->values()
            ->map(function (Item $item) use ($bin, $items, $callback) {
                $node = $this->getNode($bin->node(), $item);

                if (!is_null($node)) {
                    $item->setNode($this->createLeafNodes($node, $item->width(), $item->height()));
                }

                if (!is_null($callback)) {
                    $callback($bin, $items, $item);
                }

                return $item;
            });

        $bin->findFreeSpace($bin->node());

        return $items;
    }

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

    protected function findNode(Node $node, int $width, int $height): ?Node
    {
        if ($node->isTaken()) {
            return $this->findNode($node->right(), $width, $height) ?: $this->findNode($node->down(), $width, $height);
        } elseif ($width <= $node->width() && $height <= $node->height()) {
            return $node;
        }

        return null;
    }

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
