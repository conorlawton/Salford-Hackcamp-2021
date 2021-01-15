<?php

class CategorySearchModel
{

    private $id, $category;

    function __construct($idParam, $categoryParam)
    {

        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->id = $idParam;
        $this->category = $categoryParam;

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
    public function getCategory()
    {
        return $this->category;
    }

}

?>
