<?php
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
	require_once __DIR__ . "/../Models/ProblemModel.php";
	require_once __DIR__ . "/../Models/CustomerModel.php";
	
	class AddProblemController extends ControllerBase
	{
		private $user;
		
		function __construct($user)
		{
			$this->user = $user;
			$this->view = new ViewBase("Add Problem", "/Views/AddProblemView.phtml");
		}
		
		function get(): void
		{
			$this->view->view();
		}
		
		function post(): void
		{
			$exists = CustomerModel::check_if_exists($_POST['CustomerID']);
			if ($exists === true)
			{
				ProblemModel::insert_problem($_POST['urgency'], $_POST['description'], $_POST['categorisation_id'], $this->user->id, $_POST['CustomerID']);
			}
			elseif ($exists === false)
			{
				$_SESSION["add_problem_message"] = "Failed to add problem: Unknown error";
			}
			elseif ($exists === null)
			{
				$_SESSION["invalid_customer_id"] = true;
			}
			
			header("Location: /AddProblem");
		}
	}
	

