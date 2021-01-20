<?php
	require_once "Core/ControllerBase.php";
	require_once "Core/ViewBase.php";
	require_once "Models/ProblemModel.php";
	require_once "Models/CustomerModel.php";
	
	class UpdateProblemController extends ControllerBase
	{
		private $user;
		
		function __construct($user)
		{
			$this->user = $user;
			$this->view = new ViewBase("Update Problem", "/Views/UpdateProblemView.phtml");
		}
		
		function get(): void
		{
			$this->view->view();

            $exists = CustomerModel::check_if_exists($_GET['CustomerID']);
            if ($exists === true)
            {
                $escaped_text = htmlspecialchars($_GET['description'], ENT_QUOTES | ENT_HTML5);
                ProblemModel::update_problem($_GET['urgency'], $escaped_text, $_GET['categorisation_id'], $this->user->id, $_GET['CustomerID']);
            }
            elseif ($exists === false)
            {
                $_SESSION["update_problem_message"] = "Failed to update problem: Unknown error";
            }
            elseif ($exists === null)
            {
                $_SESSION["invalid_customer_id"] = true;
            }

            header("Location: /UpdateProblem");
		}
		
		function post(): void
		{

		}
	}
	

