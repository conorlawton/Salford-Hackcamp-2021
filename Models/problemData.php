<?php
class problemData {

    protected $_Problem_id, $_Problem_urgency, $_Problem_description, $_Categorisation_id, $_Staff_uploader, $_User_id;

    public function __construct($dbRow) {
        $this->_Problem_id = $dbRow['id'];
        $this->_Problem_urgency = $dbRow['urgency'];
        $this->_Problem_description = $dbRow['Description'];
        $this->_Categorisation_id = $dbRow['categorisation_id'];
        $this->_Staff_uploader = $dbRow['staff_uploader'];
        $this->_User_id = $dbRow['user_id'];
    }
}?>