<?php

namespace App\Models;

class BackstagePass extends AbstractProduct
{
    /**
     * "Backstage passes", like aged brie, increase in quality as the sell by date approaches
     */
    public const QUALITY_INCREMENT = 1;

    /**
     * Quality doubles daily when there are this many days until the sell by date
     */
    public const QUALITY_DOUBLES_DAYS_BEFORE_SELL_BY = 10;

    /**
     * Quality triples when there are this many days until the sell by date
     */
    public const QUALITY_TRIPLES_DAYS_BEFORE_SELL_BY = 5;

    public function updateQuality()
    {
        parent::updateQuality();

        // Quality triples when there are 5 days or less
        if (
            $this->sellIn <= static::QUALITY_TRIPLES_DAYS_BEFORE_SELL_BY &&
            $this->quality < static::MAX_QUALITY
        ) {
            $this->quality += static::QUALITY_INCREMENT;
        }

        // Quality drops to 0 after the concert
        if ($this->sellIn < 0) {
            $this->quality = 0;
        }
    }
}