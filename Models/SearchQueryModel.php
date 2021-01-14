<?php

// Grab the database basic model.
require_once __DIR__ . "/DatabaseModel.php";
// Initialise a database basic model object.
$database = DatabaseModel::getInstance();

// Global Variable Calls
global $searchResolvedStatus;
global $searchRequest;
global $searchLine;

// The switch statement initially checks for which radio button filter has been selected,
// then it decided if the 'resolved' status is true or false,
// this determines the SQL statement that is chosen.
switch($searchRequest)
{

    // Search for specific Customer and their associated queries.
    case "1":

        if ($searchResolvedStatus != "1")
        {

            $sqlQuery = 'SELECT * FROM customers WHERE firstName LIKE ?';

            break;

        }
        else
        {

            $sqlQuery = 'SELECT * FROM customers WHERE firstName LIKE ?';

            break;

        }

    // Search for queries based on their description.
    case "2":

        if ($searchResolvedStatus != "1")
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

        if ($searchResolvedStatus != "1")
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

        if ($searchResolvedStatus != "1")
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

