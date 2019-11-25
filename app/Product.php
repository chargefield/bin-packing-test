<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Parse size.
     *
     * @return array
     */
    protected function parseSize(): array
    {
        return explode('x', $this->size);
    }

    /**
     * Get the width of the product.
     *
     * @return int
     */
    public function width(): int
    {
        return (int) $this->parseSize()[0];
    }

    /**
     * Get the height of the product.
     *
     * @return int
     */
    public function height(): int
    {
        return (int) $this->parseSize()[1];
    }
}
