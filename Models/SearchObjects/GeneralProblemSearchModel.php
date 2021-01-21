<?php

/*
 * This model represents a problem search result, it is general because due to its basic information nature it can be reused over multiple search filters.
 * This model is purely for search display purposes.
 */
class GeneralProblemSearchModel
{

    private $problemID, $category, $description, $urgency, $addedTime, $resolved, $staffName;

    function __construct($problemIDParam, $categoryParam, $descriptionParam, $urgencyParam, $addedTimeParam, $resolvedParam, $staffNameParam)
    {

        $this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

        $this->problemID = $problemIDParam;
        $this->category = $categoryParam;
        $this->description = $descriptionParam;
        $this->urgency = $urgencyParam;
        $this->addedTime = $addedTimeParam;
        $this->resolved = $resolvedParam;
        $this->staffName = $staffNameParam;

    }

    /**
     * @return mixed
     */
    public function getProblemID()
    {
        return $this->problemID;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
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
    public function getUrgency()
    {
        return $this->urgency;
    }

    /**
     * @return mixed
     */
    public function getAddedTime()
    {
        return $this->addedTime;
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
    public function getStaffName()
    {
        return $this->staffName;
    }

}