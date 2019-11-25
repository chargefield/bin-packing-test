<?php

namespace App\Printing;

use Illuminate\View\View;

class Preview
{
    protected $bins;

    public function __construct(Bins $bins)
    {
        $this->bins = $bins;
    }

    /**
     * Get view.
     *
     * @return \Illuminate\View\View
     */
    public function view(): View
    {
        return view('preview', [
            'bins' => $this->bins->get(),
        ]);
    }
}
