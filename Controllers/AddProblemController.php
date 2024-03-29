<?php
	require_once "Core/ControllerBase.php";
	require_once "Core/ViewBase.php";
	require_once "Models/ProblemModel.php";
	require_once "Models/CustomerModel.php";
	
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
				$escaped_text = htmlspecialchars($_POST['description'], ENT_QUOTES | ENT_HTML5);
				
				// TODO: Perform more advanced checks against all input fields
				ProblemModel::insert_problem($_POST['urgency'], $escaped_text, $_POST['categorisation_id'], $this->user->id, $_POST['CustomerID']);
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
	

