<?php

class ProblemSearchModel
{

    private $id, $urgency, $description, $resolved, $categoryID, $staffUploader, $userID, $timeAdded;

    function __construct($idParam, $urgencyParam, $descriptionParam, $resolvedParam, $categoryIDParam, $staffUploaderParam, $userIDParam, $timeAddedParam)
    {

        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->id = $idParam;
        $this->urgency = $urgencyParam;
        $this->description = $descriptionParam;
        $this->resolved = $resolvedParam;
        $this->categoryID = $categoryIDParam;
        $this->staffUploader = $staffUploaderParam;
        $this->userID = $userIDParam;
        $this->timeAdded = $timeAddedParam;

    }

    // ##########(PROBLEM ATTRIBUTES)##################################################################

    /**
     * @return mixed
     */
    public function getProblemID()
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
    public function getCategoryFK()
    {
        return $this->categoryID;
    }

    /**
     * @return mixed
     */
    public function getStaffFK()
    {
        return $this->staffUploader;
    }

    /**
     * @return mixed
     */
    public function getCustomerFK()
    {
        return $this->userID;
    }

    /**
     * @return mixed
     */
    public function getTimeAdded()
    {
        return $this->timeAdded;
    }

}

?>