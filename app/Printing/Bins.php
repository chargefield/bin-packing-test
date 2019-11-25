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

    /**
     * Add a new bin of a given size with given items.
     *
     * @param int $width
     * @param int $height
     * @param \Illuminate\Support\Collection $items
     * @return self
     */
    public function add(int $width, int $height, Collection $items): self
    {
        $this->bins->push(new Bin($width, $height, $items));

        return $this;
    }

    /**
     * Get bins.
     *
     * @return \Illuminate\Support\Collection
     */
    public function get(): Collection
    {
        return $this->bins;
    }
}
