<?php

namespace App\Models;

class BackstagePass extends AbstractProduct
{
    /**
     * "Backstage passes", like aged brie, increase in quality as the sell by date approaches
     */
    public const QUALITY_INCREMENTS = 1;

    /**
     * Quality starts doubling daily when there are this many days until the sell by date
     */
    public const QUALITY_INCREMENTS_TWICE_AS_FAST = 10;

    /**
     * Quality starts tripling daily when there are this many days until the sell by date
     */
    public const QUALITY_INCREMENTS_THRICE_AS_FAST = 5;

    protected function changeQuality()
    {
        parent::changeQuality();

        // Quality increases 3 when there are 5 days or less
        if (
            $this->sellIn <= self::QUALITY_INCREMENTS_THRICE_AS_FAST &&
            $this->quality < self::MIN_QUALITY
        ) {
            $this->quality += self::QUALITY_INCREMENTS;
        }

        // Quality drops to 0 after the concert
        if ($this->sellIn < 0) {
            $this->quality = 0;
        }
    }
}