<?php

require_once __DIR__ . "/../Models/CustomerDisplayModel.php";
class ViewCustomerController extends ControllerBase
{
    private $customerID;

    function __construct() {
        $this->view = new ViewBase("View Customer", "/Views/ViewCustomerView.phtml");

        $this->view->customerID = $_GET['customerID'];
    }

    function get(): void {

        $this->view->customer = new CustomerDisplayModel($this->view->customerID);

        $this->view->view();
    }
    public function post(): void
    {
    }







}



