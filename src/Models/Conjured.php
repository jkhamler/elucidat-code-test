<?php

namespace App\Models;

class Conjured extends AbstractProduct
{
    /**
     * "Conjured" items degrade in quality twice as fast as stand
     */
    public const QUALITY_INCREMENT = -2;
}
