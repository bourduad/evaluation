<?php

/**
 * Class MicrowaveItem
 */
class MicrowaveItem extends ElectronicItem {

    /**
     * MicrowaveItem constructor.
     * @param float $price
     */
    public function __construct(float $price) {
        parent::__construct($price, self::ELECTRONIC_ITEM_MICROWAVE, array(), false);
    }

    /**
     * Number of extra a television can have (0)
     * @return int
     */
    function maxExtras() {
        return self::MAX_EXTRA_MICROWAVE;
    }

    /**
     * A microwave cannot be considered as an extra
     * @return bool
     */
    function canBeExtra() {
        return false;
    }
}