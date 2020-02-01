<?php

namespace CompareEngineTracker\tests;

require __DIR__."/../lib/CompareEngineTracker/Annotation/PropertyTracker.php";

use CompareEngineTracker\Annotation\PropertyTracker;

/**
 * Class PhoneModel
 */
class PhoneModel
{
    /** @var string $number
     * @PropertyTracker()
     */
    protected $number;

    /** @var string $countryCode */
    protected $countryCode;

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

}
