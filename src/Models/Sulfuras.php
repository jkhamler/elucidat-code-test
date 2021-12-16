<?php

namespace App\Models;

class Sulfuras extends AbstractProduct
{
    /**
     * "Sulfuras", a legendary item, never decreases in quality
     */
    public const SELL_IN_INCREMENT = 0;

    /**
     * "Sulfuras", a legendary item, never decreases in quality
     */
    public const QUALITY_INCREMENT = 0;

    /**
     * "Sulfuras", a legendary item, always has a quality of 80
     */
    public const MIN_QUALITY = 80;

    /**
     * "Sulfuras", a legendary item, always has a quality of 80
     */
    public const MAX_QUALITY = 80;
}
