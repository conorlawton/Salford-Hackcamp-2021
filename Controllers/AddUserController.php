<?php
require_once "Core/ControllerBase.php";
require_once "Core/ViewBase.php";
require_once "Models/CustomerModel.php";

    class AddUserController extends ControllerBase
    {
        private $user;

        function __construct($user)
        {
            $this->user = $user;
            $this->view = new ViewBase("Add User", "/Views/AddProblemView.phtml");
        }

        function get(): void
        {
            $this->view->view();
        }

        function post(): void
        {
            $escaped_text = htmlspecialchars($_POST['description'], ENT_QUOTES | ENT_HTML5);

            UserModel::addNewUser($_POST["Staff_Name"], $_POST["Password"], $escaped_text, $_POST["permissions"]);

            header("Location: /AddProblem");
        }

    }