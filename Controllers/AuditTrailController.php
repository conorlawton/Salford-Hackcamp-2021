<?php

    require_once __DIR__ . "/../Core/ViewBase.php";
    require_once __DIR__ . "/../Core/ControllerBase.php";


class AuditTrailController extends ControllerBase
{
    private $user;

    function __construct($user) {
        $this->user = $user;
        $this->view = new ViewBase("Audit Trail", "/Views/AuditTrailView.phtml");
    }

    function get(): void {
        $this->view->view();
    }

    function post(): void
    {

    }

}