<?php

namespace App;

use App\Models\ProductInterface;

class GildedRose
{
    private $items;

    /**
     * GildedRose constructor.
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param null $which
     * @return array|mixed
     */
    public function getItem($which = null)
    {
        return ($which === null
            ? $this->items
            : $this->items[$which]
        );
    }

    /**
     * Every day we update the items in sock
     */
    public function nextDay()
    {
        foreach ($this->items as $item) {
            if ($item instanceof ProductInterface) {
                $item->nextDay();
            }
        }
    }
}
