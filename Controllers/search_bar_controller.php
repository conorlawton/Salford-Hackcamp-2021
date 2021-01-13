<?php

class SearchBarController
{

    public function searchBarInput()
    {

        // HEADER
        require_once ('../Views/Templates/head.phtml');

        // SEARCH BAR RE-REQUEST
                require_once ('../Views/search_bar_view.php');

        // ==========(Capture Search Request)=====================================|

        // USER INPUT CAPTURE AND STORAGE
        // Each element has to be checked and stored before hand,
        // the check is to see if anything has been captured
        // to avoid errors.

        // User String Input.
                if (isset($_POST['searchBar']))
                {

                    $searchLine = $_POST['searchBar'];

                }

        // Radio Button Input
                if (isset($_POST['searchRadio'])) {

                    $searchRequest = $_POST['searchRadio'];

                }

        // Default initialisation.
                $searchResolvedStatus = 0;

        // Checkbox
                if (isset($_POST['searchCheckbox'])) {

                    $searchResolvedStatus = $_POST['searchCheckbox'];

                }

        // The model used with the search bar is called, see the model
        // for further information.
                require_once('../Models/search_bar_model.php');

        // ==========(Posting Queries)=====================================|

        // Grabs the controller that packages the search responses ready for viewing by the user.
                require_once('query_post_controller.php');

    }

}

$searchBar = new searchBarController();
$searchBar->searchBarInput();

/*

echo "Test";
// HEADER
require_once ('../Views/Templates/head.phtml');

// SEARCH BAR RE-REQUEST
require_once ('../Views/search_bar_view.php');

// ==========(Capture Search Request)=====================================|

// USER INPUT CAPTURE AND STORAGE
// Each element has to be checked and stored before hand,
// the check is to see if anything has been captured
// to avoid errors.

// User String Input.
if (isset($_POST['searchBar']))
{

    $searchLine = $_POST['searchBar'];

}

// Radio Button Input
if (isset($_POST['searchRadio'])) {

    $searchRequest = $_POST['searchRadio'];

}

// Default initialisation.
$searchResolvedStatus = 0;

// Checkbox
if (isset($_POST['searchCheckbox'])) {

    $searchResolvedStatus = $_POST['searchCheckbox'];

}

// The model used with the search bar is called, see the model
// for further information.
require_once('../Models/search_bar_model.php');

// ==========(Posting Queries)=====================================|

// Grabs the controller that packages the search responses ready for viewing by the user.
require_once('query_post_controller.php');

/*
?>
