<?php

/**
 * Class ElectronicItems
 */
class ElectronicItems {

    /**
     * @var array
     */
    private $items = array();

    /**
     * ElectronicItems constructor.
     * @param array $items
     */
    public function __construct(array $items) {
        $this->items = $items;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }


    /**
     * @return array
     */
    public function getSortedItems() {
        $sorted = array();
        foreach ($this->items as $item) {
            $sorted[($item->getPriceTotal() * 100)] = $item;
        }

        ksort($sorted, SORT_NUMERIC);
        return $sorted;
    }

    /**
     * @param $type
     * @return false
     */
    public function getItemsByType($type) {
        if (in_array($type, ElectronicItem::getTypes())) {
            $callback = function($item) use ($type) {
                return $item->getType() == $type;
            };
            $items = array_filter($this->items, $callback);
            return $items;
        } return false;
    }

    /**
     * Return the total price of the list of items
     * @return float
     */
    public function getPriceTotal() {
        $price = 0.0;
        foreach ($this->items as $item) {
            $price += floatval($item->getPriceTotal());
        }

        return $price;
    }
}