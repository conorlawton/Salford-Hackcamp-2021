<?php

class ProblemSearchModel
{

    private $id, $urgency, $description, $resolved, $categoryID, $staffUploader, $userID;

    function __construct($idParam, $urgencyParam, $descriptionParam, $resolvedParam, $categoryIDParam, $staffUploaderParam, $userIDParam)
    {

        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->id = $idParam;
        $this->urgency = $urgencyParam;
        $this->description = $descriptionParam;
        $this->resolved = $resolvedParam;
        $this->categoryID = $categoryIDParam;
        $this->staffUploader = $staffUploaderParam;
        $this->userID = $userIDParam;

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
    public function getUrgency()
    {
        return $this->urgency;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getResolved()
    {
        return $this->resolved;
    }

    /**
     * @return mixed
     */
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    /**
     * @return mixed
     */
    public function getStaffUploader()
    {
        return $this->staffUploader;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

}

?>