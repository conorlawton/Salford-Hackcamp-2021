<?php
require_once('Models/Database.php');

$view = new stdClass();
$view->pageTitle = '';
$users = new User();

if(isset($_POST['Add'])) {
    $problemDataSet = new ProblemDataSet();
    $problemDataSet->addProblem($_POST['Urgency'], $_POST['Description'], $_POST['Categorisation_id'], $_POST['Staff_id'], $_POST['User_id']);
}

require_once('Views/addProblem.phtml');

