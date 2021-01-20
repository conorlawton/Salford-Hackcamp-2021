<?php

require_once __DIR__ . "/../Models/CustomerDisplayModel.php";
require_once __DIR__ . "/../Models/SearchObjects/GeneralProblemSearchModel.php";

class ViewCustomerController extends ControllerBase
{
    private $customerID;

    function __construct() {
        $this->view = new ViewBase("View Customer", "/Views/ViewCustomerView.phtml");

        $this->view->customerID = $_GET['customerID'];
    }

    function get(): void {

        $this->view->customer = new CustomerDisplayModel($this->view->customerID);

        // This takes the dataset array and populates it with the results of the getProblems() function, these results
        // would be a series of queries/problems associated with the customer based on the customer ID.
        $this->view->datasetOfProblems = $this->view->customer->getProblems($this->view->customerID);

        $this->view->view();
    }
    public function post(): void
    {
    }







}



