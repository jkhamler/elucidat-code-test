<?php

namespace App\Models;

use App\Item;

class AbstractProduct extends Item implements ProductInterface
{
    public function nextDay()
    {
        $this->updateSellIn();
        $this->updateQuality();
    }

    public function updateSellIn(){

    }

    public function updateQuality(){

    }
}