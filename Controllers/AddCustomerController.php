<?php
require_once "Core/ControllerBase.php";
require_once "Core/ViewBase.php";
require_once "Models/CustomerModel.php";

class AddCustomerController extends ControllerBase
{
    function __construct()
    {
        $this->view = new ViewBase("Add User", "/Views/AddCustomerView.phtml");
    }

    function get(): void
    {
        $this->view->view();
    }

    function post(): void
    {
        $escaped_text = htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_HTML5);

        CustomerModel::addNewCustomer($_POST["firstName"], $_POST["lastName"], $escaped_text, $_POST["phoneNumber"]);

        header("Location: /AddCustomer");
    }
}