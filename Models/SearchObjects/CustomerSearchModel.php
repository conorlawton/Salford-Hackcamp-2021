<?php


class CustomerSearchModel
{

    private $customerID, $customerFirstName, $customerLastName, $CustomerEmail, $customerPhoneNumber;
    function __construct($customerIDParam, $customerFirstNameParam, $customerLastNameParam, $CustomerEmailParam, $customerPhoneNumberParam)
    {
        $this->database = DatabaseModel::getInstance();

        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->customerID = $customerIDParam;
        $this->customerFirstName = $customerFirstNameParam;
        $this->customerLastName = $customerLastNameParam;
        $this->customerEmail = $CustomerEmailParam;
        $this->customerPhoneNumber = $customerPhoneNumberParam;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->customerID;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->customerFirstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->customerLastName;
    }

    /**
     * @return mixed
     */
    public function getCustomerEmail()
    {
        return $this->CustomerEmail;
    }

    /**
     * @return mixed
     */
    public function getCustomerPhoneNumber()
    {
        return $this->customerPhoneNumber;
    }


}