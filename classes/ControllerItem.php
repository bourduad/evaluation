<?php

/**
 * Class ControllerItem
 */
class ControllerItem extends ElectronicItem {

    /**
     * ControllerItem constructor.
     * @param float $price
     * @param bool $wired
     */
    public function __construct(float $price, bool $wired = REMOTE) {
        parent::__construct($price, self::ELECTRONIC_ITEM_CONTROLLER, array(), $wired);
    }

    /**
     * Number of extra a controller can have (0)
     * @return int
     */
    function maxExtras() {
        return self::MAX_EXTRA_CONTROLLER;
    }

    /**
     * A controller can be considered as an extra
     * @return bool
     */
    function canBeExtra() {
        return true;
    }
}