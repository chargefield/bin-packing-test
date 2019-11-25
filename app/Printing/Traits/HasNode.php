<?php

namespace App\Printing\Traits;

use App\Printing\Node;

trait HasNode
{
    protected $node;

    /**
     * Get node
     *
     * @return \App\Printing\Node|null
     */
    public function node(): ?Node
    {
        return $this->node;
    }

    /**
     * Set node
     *
     * @param \App\Printing\Node|null $node
     * @return self
     */
    public function setNode(?Node $node): self
    {
        $this->node = $node;

        return $this;
    }
}
