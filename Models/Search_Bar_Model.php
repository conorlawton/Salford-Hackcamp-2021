<?php

// Global Variable Calls
global $searchResolvedStatus;
global $searchRequest;
global $searchLine;

// The switch statement initially checks for which radio button filter has been selected,
// then it decided if the 'resolved' status is true or false,
// this determines the SQL statement that is chosen.
switch($searchRequest)
{

    // Search by Customer
    case "1":

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

    // Search by Problem
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

    // Search by Category
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

    // Search by Staff
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

?>