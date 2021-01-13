<?php

require_once('Models/database_model.php.php');
require_once('Models/problemData.php');

class problemDataSet {
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function addProblem($urgency, $description, $categorisation_id, $staff_id, $user_id)
    {
        $sqlQuery = "INSERT INTO problems (urgency, Description, categorisation_id, staff_uploader, user_id) VALUES (?,?,?,?,?);";

        $statement = $this->_dbHandle->prepare($sqlQuery);

        $statement->bindParam(1,$urgency); //sets the bind variables which help with efficiency and helps protect against SQL injection
        $statement->bindParam(2,$description);
        $statement->bindParam(3,$categorisation_id);
        $statement->bindParam(4,$staff_id);
        $statement->bindParam(5,$user_id);

        $statement->execute(); //executes the variable
    }
}