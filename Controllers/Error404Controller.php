<?php
    require_once __DIR__ . "/../Core/ControllerBase.php";
    require_once __DIR__ . "/../Core/ViewBase.php";

class Error404Controller extends ControllerBase
{
    function __construct(){
        $this->view = new ViewBase("404","/Views/Error404View.phtml");
    }

    function get(): void
    {
        $this->view->view();
    }
}