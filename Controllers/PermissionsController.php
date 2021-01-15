<?php
require_once __DIR__ . "/../Models/DatabaseModel.php";
require_once __DIR__ . "/../Core/ControllerBase.php";

class PermissionsController
{
    static function checkAdmin($user)
    {
        if($user->getPermissions & 1) {
            return true;
        }
        else {
            return false;
        }
    }
}


