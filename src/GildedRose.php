<?php

namespace App;

class GildedRose
{

    const REGULAR_DEGRADATION_RATE = 1;
    const CONJURED_DEGRADATION_RATE = 2;
    
    const MAXIMUM_QUALITY = 50;
    
    const AGED_BRIE = 'Aged Brie';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';

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
     * This method updates the quality and 'sell in' properties of items depending on their properties
     * and whether they are 'conjured'
     * 
     * @param bool $conjured
     */
    public function nextDay($conjured = false)
    {
        $degradationRate = $conjured ? self::CONJURED_DEGRADATION_RATE : self::REGULAR_DEGRADATION_RATE;

        foreach ($this->items as $item) {
            if ($item->name != self::AGED_BRIE and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                if ($item->quality > 0) {
                    if ($item->name != self::SULFURAS) {
                        $item->quality = $item->quality - $degradationRate;
                    }
                }
            } else {
                if ($item->quality < self::MAXIMUM_QUALITY) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->sellIn < 11) {
                            if ($item->quality < self::MAXIMUM_QUALITY) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sellIn < 6) {
                            if ($item->quality < self::MAXIMUM_QUALITY) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }
            if ($item->name != self::SULFURAS) {
                $item->sellIn = $item->sellIn - 1;
            }
            if ($item->sellIn < 0) {
                if ($item->name != self::AGED_BRIE) {
                    if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                        if ($item->quality > 0) {
                            if ($item->name != self::SULFURAS) {
                                $item->quality = $item->quality - $degradationRate;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < self::MAXIMUM_QUALITY) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }

}
