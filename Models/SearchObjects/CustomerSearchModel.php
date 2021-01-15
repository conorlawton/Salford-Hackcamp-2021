<?php

class CustomerSearchModel
{

    private $id, $firstName, $lastName, $email, $phoneNumber;

    function __construct($idParam, $firstNameParam, $lastNameParam, $emailParam, $phoneNumberParam)
    {

        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->id = $idParam;
        $this->firstName = $firstNameParam;
        $this->lastName = $lastNameParam;
        $this->email = $emailParam;
        $this->phoneNumber = $phoneNumberParam;

    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

}