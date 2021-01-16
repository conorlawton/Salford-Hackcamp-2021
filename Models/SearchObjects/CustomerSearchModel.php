<?php


class CustomerSearchModel
{

    private $problemID, $urgency, $description, $resolved, $categoryFK, $staffFK, $CustomerFK, $timeAdded;
    private $customerID, $customerFirstName, $customerLastName, $CustomerEmail, $customerPhoneNumber;
    private $staffID, $staffName, $StaffEmail;
    private $categoryID, $category;

    function __construct($problemIDParam, $urgencyParam, $descriptionParam, $resolvedParam, $categoryFKParam, $staffFKParam, $CustomerFKParam, $timeAddedParam,
                         $customerIDParam, $customerFirstNameParam, $customerLastNameParam, $CustomerEmailParam, $customerPhoneNumberParam,
                         $staffIDParam, $staffNameParam, $StaffEmailParam,
                         $categoryIDParam, $categoryParam)
    {

        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->problemID = $problemIDParam;
        $this->urgency = $urgencyParam;
        $this->description = $descriptionParam;
        $this->resolved = $resolvedParam;
        $this->categoryFK = $categoryFKParam;
        $this->staffFK = $staffFKParam;
        $this->customerFK = $CustomerFKParam;
        $this->timeAdded = $timeAddedParam;

        $this->customerID = $customerIDParam;
        $this->customerFirstName = $customerFirstNameParam;
        $this->customerLastName = $customerLastNameParam;
        $this->customerEmail = $CustomerEmailParam;
        $this->customerPhoneNumber = $customerPhoneNumberParam;

        $this->staffID = $staffIDParam;
        $this->staffName = $staffNameParam;
        $this->staffEmail = $StaffEmailParam;

        $this->categoryID = $categoryIDParam;
        $this->category = $categoryParam;

    }

    // ##########(PROBLEM ATTRIBUTES)##################################################################

    /**
     * @return mixed
     */
    public function getProblemID()
    {
        return $this->problemID;
    }

    /**
     * @return mixed
     */
    public function getUrgency()
    {
        return $this->urgency;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getResolved()
    {
        return $this->resolved;
    }

    /**
     * @return mixed
     */
    public function getCategoryFK()
    {
        return $this->categoryFK;
    }

    /**
     * @return mixed
     */
    public function getStaffFK()
    {
        return $this->staffFK;
    }

    /**
     * @return mixed
     */
    public function getCustomerFK()
    {
        return $this->customerFK;
    }

    /**
     * @return mixed
     */
    public function getTimeAdded()
    {
        return $this->timeAdded;
    }

    // ##########(CUSTOMER ATTRIBUTES)##################################################################

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

    // ##########(STAFF ATTRIBUTES)##################################################################

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->staffID;
    }

    /**
     * @return mixed
     */
    public function getStaffName()
    {
        return $this->staffName;
    }

    /**
     * @return mixed
     */
    public function getStaffEmail()
    {
        return $this->staffEmail;
    }

    // ##########(CATEGORY ATTRIBUTES)##################################################################

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryID;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

}