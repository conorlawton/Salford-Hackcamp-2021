<?php

// Grab the database basic model.
require_once __DIR__ . "/DatabaseModel.php";
require_once __DIR__ . "/SearchModel.php";

class SearchQueryModel
{

    // Variable Calls
    private $searchResolvedStatus;
    private $searchRequest;
    private $searchLine;
    private $dataset = [];

    function __construct($resolved, $request, $line)
    {
        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->searchResolvedStatus = $resolved;
        $this->searchRequest = $request;
        $this->searchLine = $line;

    }

    function view(): void
    {
        $this->view->view();
    }

    public function getDataset()
    {

        return $this->dataset;

    }

    public function searchBarQuery()
    {

        // Initialise a database basic model object.
        $database = DatabaseModel::getInstance();

        $nameArray = explode(" ", $this->searchLine);

        if($nameArray[0])
        {

            $chopFirstName = $nameArray[0];

        }
        else
        {

            $chopFirstName = "";

        }

        if($nameArray[1])
        {

            $chopLastName = $nameArray[1];

        }
        else
        {

            $chopLastName = "";

        }

        // The switch statement initially checks for which radio button filter has been selected,
        // then it decided if the 'resolved' status is true or false,
        // this determines the SQL statement that is chosen.
        switch($this->searchRequest)
        {

            // Search for specific Customer and their associated queries.
            case "1":
            {

                $sqlQuery = $database->getDBConnection()->prepare("SELECT * FROM salfordhackcamp2020.customers WHERE firstName LIKE ? AND lastName LIKE ?");
                $sqlQuery->bind_result($id, $firstName, $lastName, $email, $phoneNumber);
                $sqlQuery->bind_param("ss", $chopFirstName, $chopLastName);
                $sqlQuery->execute();

                while ($sqlQuery->fetch()) {

                    array_push($this->dataset, new SearchModel($id, $firstName, $lastName, $email, $phoneNumber));

                }

                $sqlQuery->close();

            }

            // Search for queries based on their description.
            case "2":

                if ($this->searchResolvedStatus != "1")
                {

                    $sqlQuery = '';

                    break;

                }
                else
                {

                    $sqlQuery = '';

                    break;

                }

            // Search for all queries in a specific Category.
            case "3":

                if ($this->searchResolvedStatus != "1")
                {

                    $sqlQuery = '';

                    break;

                }
                else
                {

                    $sqlQuery = '';

                    break;

                }

            // Search for all queries associated with a specific member of Staff.
            case "4":

                if ($this->searchResolvedStatus != "1")
                {

                    $sqlQuery = '';

                    break;

                }
                else
                {

                    $sqlQuery = '';

                    break;

                }

        }

// Database handling
// $statement = $database->getDBConnection()->prepare($sqlQuery);

    }

}


