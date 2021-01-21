<?php
    require_once "Core/ControllerBase.php";
    require_once "Core/ViewBase.php";
    require_once "Models/UserModel.php";

    class AddUserController extends ControllerBase
    {
        function __construct()
        {
            $this->view = new ViewBase("Add User", "/Views/AddUserView.phtml");
        }

        function get(): void
        {
            $this->view->view();
        }

        function post(): void
        {
            $escaped_text = htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_HTML5);

            UserModel::addNewUser($_POST["Staff_Name"], password_hash($_POST["Password"], PASSWORD_DEFAULT), $escaped_text, $_POST["permissions"]);

            header("Location: /AddUser");
        }
    }