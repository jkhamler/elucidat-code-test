<?php

namespace App\Models;

use App\Item;

abstract class AbstractProduct extends Item implements ProductInterface
{
    /**
     * @var int we increment the 'sell in' value by this much each day
     */
    public const SELL_IN_INCREMENT = -1;

    /**
     * @var int we increment the 'quality' value by this much each day
     */
    public const QUALITY_INCREMENT = -1;

    /**
     * @var int By how many days from the sell by date does the quality value start degrading twice as fast
     */
    public const QUALITY_DOUBLES_DAYS_BEFORE_SELL_BY = 0;

    /**
     * @var int Minimum quality value
     */
    public const MIN_QUALITY = 0;

    /**
     * @var int Maximum quality value
     */
    public const MAX_QUALITY = 50;


    public function nextDay()
    {
        $this->updateSellIn();
        $this->updateQuality();
    }

    public function updateSellIn()
    {
        $this->sellIn += static::SELL_IN_INCREMENT;
    }

    public function updateQuality()
    {
        $this->quality += static::QUALITY_INCREMENT;

        // Once the sell by date has passed, Quality degrades twice as fast
        if ($this->sellIn < static::QUALITY_DOUBLES_DAYS_BEFORE_SELL_BY) {
            $this->quality += static::QUALITY_INCREMENT;
        }

        // The Quality of an item cannot be below this amount
        if ($this->quality < static::MIN_QUALITY) {
            $this->quality = static::MIN_QUALITY;
        }

        // The Quality of an item never exceeds this amount
        if ($this->quality > static::MAX_QUALITY) {
            $this->quality = static::MAX_QUALITY;
        }
    }
}