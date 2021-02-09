<?php

/**
 * Abstract class where are defined most variables and constants
 * Class ElectronicItem
 */
abstract class ElectronicItem {
    /**
     * Price of the item
     * @var float
     */
    public $price;      // Price of the item : float

    /**
     * Type of the item : could be television, console, microwave or controller
     * @var string
     */
    protected $type;

    /**
     * @var bool
     */
    public $wired;

    /**
     * @var array
     */
    protected $extras;

    /**
     * Error code if there's a problem when creating the item
     * @var int
     */
    protected $errCode = "";

    // List of available types
    const ELECTRONIC_ITEM_TELEVISION = 'television';
    const ELECTRONIC_ITEM_CONSOLE = 'console';
    const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    const ELECTRONIC_ITEM_CONTROLLER = 'controller';

    //Array of the types
    private static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE,
        self::ELECTRONIC_ITEM_TELEVISION,
        self::ELECTRONIC_ITEM_CONTROLLER
    );

    // List of number of maximum extras
    const NO_MAX_EXTRAS = -1;
    const MAX_EXTRA_CONSOLE = 4;
    const MAX_EXTRA_TELEVISION = self::NO_MAX_EXTRAS;
    const MAX_EXTRA_MICROWAVE = 0;
    const MAX_EXTRA_CONTROLLER = 0;

    /**
     * ElectronicItem constructor ONLY the validation is ok.
     * @param float $price
     * @param string $type
     * @param array $extras
     * @param bool $wired
     */
    public function __construct(float $price, string $type, array $extras, bool $wired) {
        $this->validateData($price, $type, $extras, $wired);
        if($this->getErrCode() == 0) {
            $this->setPrice($price);
            $this->setType($type);
            $this->setExtras($extras);
            $this->setWired($wired);
            $this->setType($type);
        }
    }

    /**
     * Validate the data receive to create the entry.
     * Validation code :    Error validation code is coded as an int of 4 bits (value from 0 to 15). Bit informations
     *                      are coded from right to left:
     *                      1: invalid price (ie not numeric or less than 0)
     *                      2: invalid type (ie not in the list. Should never be triggered but better be safe than sorry)
     *                      3: invalid wired type (by default it is wired or not. Should never being triggered)
     *                      4: extras are invalids (ie number of extras are too big)
     *
     * @param float $price
     * @param string $type
     * @param array $extras
     * @param bool $wired
     */
    protected function validateData(float $price, string $type, array $extras, bool $wired) {
        $errCode = "";

        // 1st bit
        if(!is_numeric($price) || floatval($price) < 0.0)
            $errCode =  "1" . $errCode;
        else
            $errCode = "0" . $errCode;

        // 2nd bit
        if(!in_array($type, self::$types))
            $errCode = "1" . $errCode;
        else
            $errCode = "0" . $errCode;

        // 3th bit
        if(!is_bool($wired))
            $errCode = "1" . $errCode;
        else
            $errCode = "0" . $errCode;

        // 4th bit
        if($this->maxExtras() != self::NO_MAX_EXTRAS && count($extras) > $this->maxExtras())
            $errCode = "1" . $errCode;
        else {
            $allGood = true;
            foreach ($extras as $extra) {
                if(!$extra->canBeExtra()) {
                    $allGood = false;
                    break;
                }
            }
            if(!$allGood)
                $errCode = "1" . $errCode;
            else
                $errCode = "0" . $errCode;
        }

        $this->setErrCode(bindec($errCode));
        if($this->getErrCode() != 0)
            trigger_error("Error in data entry! Error ".$this->getErrCode()." for type $type price $price extras " . json_encode($extras) . " wired $wired", E_USER_ERROR);
    }

    // GETTERS

    /**
     * @return array
     */
    public function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * @return int
     */
    public function getErrCode(): int
    {
        return $this->errCode;
    }

    /**
     * @return float
     */
    function getPrice() {
        $tempPrice = 0;
        foreach ($this->getExtras() as $extra) {
            $tempPrice += floatval($extra->getPrice());
        }
        return ($tempPrice + floatval($this->price));
    }

    /**
     * @return string
     */
    function getType() {
        return $this->type;
    }

    /**
     * @return bool
     */
    function getWired() {
        return $this->wired;
    }

    /**
     * @return string[]
     */
    public static function getTypes()
    {
        return self::$types;
    }

    // SETTERS

    /**
     * @param int $errCode
     */
    public function setErrCode(int $errCode)
    {
        $this->errCode = $errCode;
    }

    /**
     * @param array $extras
     */
    public function setExtras(array $extras)
    {
        $this->extras = $extras;
    }

    /**
     * @param $price
     */
    function setPrice($price) {
        $this->price = $price;
    }

    /**
     * @param $type
     */
    function setType($type){
        $this->type = $type;
    }

    /**
     * @param $wired
     */
    function setWired($wired) {
        $this->wired = $wired;
    }

    // Abstract methods children class must being declared

    /**
     * Returns the maximum extras an item can have
     * @return int
     */
    abstract function maxExtras();

    /**
     * Returns if the item can be considered as an extra or not
     * @return bool
     */
    abstract function canBeExtra();
}