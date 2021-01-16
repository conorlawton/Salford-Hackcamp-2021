<?php

class StaffSearchModel
{

    private $id, $name, $email;

    function __construct($idParam, $nameParam, $emailParam)
    {

        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->id = $idParam;
        $this->name = $nameParam;
        $this->email = $emailParam;

    }

    /**
     * @return mixed
     */
    public function getStaffId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getStaffName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getStaffEmail()
    {
        return $this->email;
    }

}

?>