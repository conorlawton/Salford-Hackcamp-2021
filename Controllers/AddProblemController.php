<?php
	require_once __DIR__ . "/../Models/DatabaseModel.php";
	
	$view = new stdClass();
	$view->pageTitle = '';
	$users = new User();
	
	if (isset($_POST['Add']))
	{
		$problem_data_set = new ProblemModel();
		$problem_data_set->add_problem($_POST['Urgency'], $_POST['Description'], $_POST['Categorisation_id'], $_POST['Staff_id'], $_POST['User_id']);
	}
	
	require_once __DIR__ . "/../Views/AddProblem.phtml";

