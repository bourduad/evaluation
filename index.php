<?php

include_once("config/config.php");

/**
 * For this test, I've decided to concentrate my efforts on the declaration and the constructs of the classes.
 * The operations for modifying the data after creation was not made, especially for the validation part.
 */

$list = new ElectronicItems(array(
    new ConsoleItem(500, array(
        new ControllerItem(25, REMOTE),
        new ControllerItem(25, REMOTE),
        new ControllerItem(15, WIRED),
        new ControllerItem(15, WIRED)
    )),
    new TelevisionItem(300, array(
        new ControllerItem(15, REMOTE),
        new ControllerItem(15, REMOTE)
    )),
    new TelevisionItem(700, array(
        new ControllerItem(15, REMOTE)
    )),
    new MicrowaveItem(300)
));

echo "Question 1: List of products with total price:<br/><br/>";
foreach ($list->getSortedItems() as $item) {
    echo "type: " . $item->getType() . " Price: " . $item->getPriceTotal() . "$<br/>";
}
echo "Total price: " . $list->getPriceTotal() . "$<br/>";

echo "<br/>Question 2 : price of the console with the controllers<br/>";

foreach ($list->getItemsByType("console") as $console) {
    echo $console->getType() . " " . $console->getPrice() . "$<br/>";
    foreach($console->getExtras() as $extra) {
        echo $extra->getType() . " " . $extra->getWired() . " " . $extra->getPrice() . "$<br/>";
    }
}

die("<br/>Done<br/>");