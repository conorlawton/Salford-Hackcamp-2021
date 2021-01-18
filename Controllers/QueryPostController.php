<?php

require_once 'Models/SearchModel.php';

class QueryPostController
{

    private $dataset, $searchRequest;

    function __construct($datasetParam, $searchRequestParam)
    {
        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->dataset = $datasetParam;
        $this->searchRequest = $searchRequestParam;

    }

    function queryPostController()
    {

        switch($this->searchRequest) {

            // Customer
            case "1":

                /*
                // Here each row is taken in turn as an array, the data extracted,
                // then the filed data is sent off the view to be displayed to the user.
                while ($row = $this->dataset->fetch())
                {

                    echo("TESTING");
                    $id = $row[0];
                    $firstName = $row[1];
                    $lastName = $row[2];
                    $email = $row[3];
                    $phoneNumber = $row[4];
                    echo($row[0]);
                    // View is called.
                    include('../Views/SearchResultsViews/CustomerResultView.php');

                }
                */

                foreach ($this->dataset as $row)
                {

                    $id = $row->getID();
                    $firstName = $row->getFirstName();
                    $lastName = $row->getLastName();
                    $email = $row->getEmail();
                    $phoneNumber = $row->getPhoneNumber();

                    //include __DIR__ . '/../Views/SearchResultsViews/CustomerResultView.php';

                    // Here the raw HTML output is assembled with the database retrieved data into a lot item, ready for display.

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

    }

}

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

?>