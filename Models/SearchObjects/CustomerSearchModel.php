<?php

/* This model represents specifically a customer search, all of the data that is collected by a customer search is stored here,
 * This is done so the information can be safely transported to the view.
 */
class CustomerSearchModel
{

    private $customerID, $customerFirstName, $customerLastName, $CustomerEmail, $customerPhoneNumber, $queryCount;

    function __construct($customerIDParam, $customerFirstNameParam, $customerLastNameParam, $CustomerEmailParam, $customerPhoneNumberParam, $queryCountParam)
    {

        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->customerID = $customerIDParam;
        $this->customerFirstName = $customerFirstNameParam;
        $this->customerLastName = $customerLastNameParam;
        $this->customerEmail = $CustomerEmailParam;
        $this->customerPhoneNumber = $customerPhoneNumberParam;
        $this->queryCount = $queryCountParam;

    }

    /**
     * @return mixed
     */
    public function getCustomerID()
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
        return $this->customerEmail;
    }

    /**
     * @return mixed
     */
    public function getCustomerPhoneNumber()
    {
        return $this->customerPhoneNumber;
    }

    /**
     * @return mixed
     */
    public function getQueryCount()
    {
        return $this->queryCount;
    }

}