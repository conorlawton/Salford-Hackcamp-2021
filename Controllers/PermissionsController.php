<?php
require_once __DIR__ . "/../Models/DatabaseModel.php";
require_once __DIR__ . "/../Core/ControllerBase.php";

class PermissionsController
{
    static function checkAdmin($user)
    {
        return !!($user->getPermissions() & 1);
    }


    static function checkTeamLeader($user)
    {
        return !!($user->getPermissions() & 2);
    }
}


