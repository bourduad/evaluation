<?php

/**
 * Class ConsoleItem
 */
class ConsoleItem extends ElectronicItem {

    /**
     * ConsoleItem constructor.
     * @param float $price
     * @param array $extras
     */
    public function __construct(float $price, array $extras = array()) {
        parent::__construct($price, self::ELECTRONIC_ITEM_CONSOLE, $extras, false);
    }

    /**
     * Number of extra a console can have (4)
     * @return int
     */
    function maxExtras() {
        return self::MAX_EXTRA_CONSOLE;
    }

    /**
     * A console cannot be considered as an extra
     * @return bool
     */
    function canBeExtra() {
        return false;
    }
}