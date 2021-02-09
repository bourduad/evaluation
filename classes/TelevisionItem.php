<?php


class TelevisionItem extends ElectronicItem {

    /**
     * TelevisionItem constructor.
     * @param float $price
     * @param array $extras
     */
    public function __construct(float $price, array $extras = array()) {
        parent::__construct($price, self::ELECTRONIC_ITEM_TELEVISION, $extras, false);
    }

    /**
     * Number of extra a television can have (-1 = no limit)
     * @return int
     */
    function maxExtras() {
        return self::MAX_EXTRA_TELEVISION;
    }

    /**
     * A television cannot be considered as an extra
     * @return bool
     */
    function canBeExtra() {
        return false;
    }
}