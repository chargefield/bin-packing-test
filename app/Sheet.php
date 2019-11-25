<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    const MAX_WIDTH = 10;

    const MAX_HEIGHT = 15;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
