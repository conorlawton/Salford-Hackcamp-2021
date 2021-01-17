<?php

require_once __DIR__ . "/../Models/SearchObjects/CustomerSearchModel.php";
require_once __DIR__ . "/../Models/SearchObjects/ProblemSearchModel.php";
require_once __DIR__ . "/../Models/SearchObjects/CategorySearchModel.php";
require_once __DIR__ . "/../Models/SearchObjects/StaffSearchModel.php";

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

                // Here each row is taken in turn as an array, the data extracted,
                // then the filed data is sent off the view to be displayed to the user.
                foreach ($this->dataset as $row)
                {

                    // Customer
                    $customerID = $row->getID();
                    $CustomerFirstName = $row->getFirstName();
                    $CustomerLastName = $row->getLastName();
                    $CustomerEmail = $row->getCustomerEmail();
                    $CustomerPhoneNumber = $row->getCustomerPhoneNumber();
                }

                break;

            // Problem
            case "2":

                // Here each row is taken in turn as an array, the data extracted,
                // then the filed data is sent off the view to be displayed to the user.
                /** @var ProblemSearchModel $row */
                foreach ($this->dataset as $row)
                {
                    $id = $row->getID();
                    $urgency = $row->getUrgency();
                    $description = $row->getDescription();
                    $resolved = $row->getResolved();
                    $categoryID = $row->getCategoryID();
                    $staffUploader = $row->getStaffUploader();
                    $userID = $row->getUserID();

                    // View is called.
                    //include __DIR__ . '/../Views/SearchResultsViews/ProblemResultsView.php';

                }

                break;

            // Category
            case "3":

                // Here each row is taken in turn as an array, the data extracted,
                // then the filed data is sent off the view to be displayed to the user.
                foreach ($this->dataset as $row)
                {

                    $id = $row[0];
                    $category = $row[1];

                    // View is called.
                    //include __DIR__ . '/../Views/SearchResultsViews/CategoryResultView.php';

                }

                break;

            // Staff
            case "4":

                // Here each row is taken in turn as an array, the data extracted,
                // then the filed data is sent off the view to be displayed to the user.
                foreach ($this->dataset as $row)
                {

                    $id = $row[0];
                    $name = $row[1];
                    $email = $row[3];

                    // View is called.
                    //include __DIR__ . '/../Views/SearchResultsViews/StaffResultView.php';

                }

                break;

        }

    }

}

?>