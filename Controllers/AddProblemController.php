<?php
	require_once __DIR__ . "/../Models/DatabaseModel.php";
	require_once __DIR__ . "/../Models/UserModel.php";
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
    require_once __DIR__ . "/../Models/ProblemModel.php";
	
	class AddProblemController extends ControllerBase
	{
		private $user;
		
		function __construct($user) {
			$this->user = $user;
			$this->view = new ViewBase("Add Problem", "/Views/AddProblemView.phtml");
		}
		
		function view(): void {
			$this->view->view();
		}
	}
	
	// Page logic here
	
	if (isset($_POST['submitBTN']))
	{
		ProblemModel::add_problem($_POST['urgency'], $_POST['description'], $_POST['categorisation_id'], $_SESSION['user']->id, $_POST['CustomerID']);
	}
	

