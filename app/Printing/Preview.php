<?php

namespace App\Printing;

use Illuminate\Support\Collection;

class Preview
{
    protected $bins;

    public function __construct(Bins $bins)
    {
        $this->bins = $bins;
    }

    public function view()
    {
        return view('preview', [
            'bins' => $this->bins->create(),
        ]);
    }
}
