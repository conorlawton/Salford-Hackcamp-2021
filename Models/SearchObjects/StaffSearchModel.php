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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

}

?>