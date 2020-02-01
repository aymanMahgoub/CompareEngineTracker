<?php

namespace CompareEngineTracker\tests;

use CompareEngineTracker\Annotation\PropertyTracker;

/**
 * Class PersonModel
 */
class PersonModel
{
    /** @var string $name
     * @PropertyTracker()
     */
    protected $name;

    /** @var  string $address */
    protected $address;

    /** @var mixed $phone
     * @PropertyTracker()
     */
    protected $phone;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param $phone
     *
     * @return mixed
     */
    public function setPhone($phone)
    {
        if (!is_array($phone)) {
            return false;
        }
        $personPhone = new PhoneModel();
        $personPhone->setNumber($phone['number']);
        $personPhone->setCountryCode($phone['countryCode']);
        $this->phone = $personPhone;
    }

}
