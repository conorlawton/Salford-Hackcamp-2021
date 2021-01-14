<?php

class QueryPostController
{

    private $dataset;

    private

    function __construct($datasetParam)
    {
        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->dataset = $datasetParam;

    }

    function queryPostController()
    {

        //

    }

}

global $statement;
global $searchRequest;

// Customer
global $id;
global $firstName;
global $lastName;
global $email;
global $phoneNumber;

// Problem
global $id;
global $urgency;
global $description;
global $resolved;

// Category
global $id;
global $category;

//Staff
global $id;
global $name;
global $email;

switch($searchRequest) {

        // Customer
    case "1":

        // Here each row is taken in turn as an array, the data extracted,
        // then the filed data is sent off the view to be displayed to the user.
        while ($row = $statement->fetch())
        {

            $id = $row[0];
            $firstName = $row[1];
            $lastName = $row[2];
            $email = $row[3];
            $phoneNumber = $row[4];

            // View is called.
            include('../Views/SearchResultsViews/CustomerResultView.php');

        }
        break;

        // Problem
    case "2":

        // Here each row is taken in turn as an array, the data extracted,
        // then the filed data is sent off the view to be displayed to the user.
        while ($row = $statement->fetch())
        {

            $id = $row[0];
            $urgency = $row[1];
            $description = $row[2];
            $resolved = $row[3];

            // View is called.
            include('../Views/SearchResultsViews/ProblemResultsView.php');

        }
        break;

        // Category
    case "3":

        // Here each row is taken in turn as an array, the data extracted,
        // then the filed data is sent off the view to be displayed to the user.
        while ($row = $statement->fetch())
        {

            $id = $row[0];
            $category = $row[1];

            // View is called.
            include('../Views/SearchResultsViews/CategoryResultView.php');

        }
        break;

        // Staff
    case "4":

        // Here each row is taken in turn as an array, the data extracted,
        // then the filed data is sent off the view to be displayed to the user.
        while ($row = $statement->fetch())
        {

            $id = $row[0];
            $name = $row[1];
            $email = $row[3];

            // View is called.
            include('../Views/SearchResultsViews/StaffResultView.php');

        }
        break;

}

?>