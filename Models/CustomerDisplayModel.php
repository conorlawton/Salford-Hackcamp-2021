<?php

class CustomerDisplayModel
{
    private $customerID ,$customerFirstName, $customerLastName, $customerEmail, $customerPhoneNumber, $database;

    private $dataset = [];
    private $datasetOfProblems = [];

    function __construct($ID)
    {
        $this->database = DatabaseModel::getInstance();
        $sqlQuery = $this->database->getDBConnection()->prepare("SELECT * 
                                                                             FROM customers
                                                                             WHERE id = ?");

        $sqlQuery->bind_result($customerID, $customerFirstName, $customerLastName, $customerEmail, $customerPhoneNumber);
        $sqlQuery->bind_param("i", $ID);

        // The statement is executed.
        $sqlQuery->execute();

        // Here each row is fetched and the desired attributes are fed into an object that represents this search.
        while ($sqlQuery->fetch())
        {

           array_push($this->dataset,$customerID, $customerFirstName, $customerLastName, $customerEmail, $customerPhoneNumber);

        }

        // The SQL query is cleared.
        $sqlQuery->close();

        $this->customerID = $this->dataset[0];
        $this->customerFirstName = $this->dataset[1];
        $this->customerLastName = $this->dataset[2];
        $this->customerEmail = $this->dataset[3];
        $this->customerPhoneNumber = $this->dataset[4];
    }

    function getProblems($ID)
    {

        $this->database = DatabaseModel::getInstance();

        // Prepares the SQL statement and puts it into the variable $sqlQuery.
        $sqlQuery = $this->database->getDBConnection()->prepare("SELECT problems.id, categorisation.category, problems.description, problems.urgency, problems.time_when_added, problems.resolved, staff.name
                                                                             FROM problems, categorisation, staff
                                                                             WHERE problems.staff_id = staff.id
                                                                             AND problems.category_id = categorisation.id
                                                                             AND problems.customer_id = ?;");

        // Binds the result, every attribute coming back from the database must be stated here, even if it is not used.
        $sqlQuery->bind_result($problemID, $category, $description, $urgency, $addedTime, $resolved, $staffName);

        // Here both of the variables used in the SQL statement are defined, represented in the statement as '?'.
        $sqlQuery->bind_param("i", $ID);

        // The statement is executed.
        $sqlQuery->execute();

        // Here each row is fetched and the desired attributes are fed into an object that represents this search.
        while ($sqlQuery->fetch())
        {

            array_push($this->datasetOfProblems, new GeneralProblemSearchModel($problemID, $category, $description, $urgency, $addedTime, $resolved, $staffName));

        }

        // The SQL query is cleared.
        $sqlQuery->close();

        return $this->datasetOfProblems;

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
    public function getCustomerFirstName()
    {
        return $this->customerFirstName;
    }

    /**
     * @return mixed
     */
    public function getCustomerLastName()
    {
        return $this->customerLastName;
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
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }



}