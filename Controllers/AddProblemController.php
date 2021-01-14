<?php
	require_once __DIR__ . "/../Models/DatabaseModel.php";
	require_once __DIR__ . "/../Models/UserModel.php";
	
	class AddProblemController extends ControllerBase
	{
		private $user;
		
		function __construct($user) {
			$this->user = $user;
			$this->view = new ViewBase("Add Problem", "/Views/AddProblem.phtml");
		}
		
		function view(): void {
			$this->view->view();
		}
	}
	
	// Page logic here
	
	if (isset($_POST['Add']))
	{
		ProblemModel::add_problem($_POST['Urgency'], $_POST['Description'], $_POST['Categorisation_id'], $_POST['Staff_id'], $_POST['User_id']);
	}
	

