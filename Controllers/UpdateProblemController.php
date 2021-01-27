<?php
	require_once "Core/ControllerBase.php";
	require_once "Core/ViewBase.php";
	require_once "Models/ProblemModel.php";
	require_once "Models/CustomerModel.php";
	
	class UpdateProblemController extends ControllerBase
	{
		function __construct()
		{
			$this->view = new ViewBase("Update Problem", "/Views/UpdateProblemView.phtml");
		}
		
		function get(): void
		{
			$this->view->problem = ProblemModel::get_by_id($_GET['id']);
			$this->view->id = $_GET["id"];
			$this->view->view();
		}
		
		function post(): void
		{
			if (isset($_POST['submitBTN']))
			{
				ProblemModel::update_problem(
					$_POST["problem-urgency"],
					$_POST["problem-description"],
					$_POST["problem-category-id"],
					$_POST["problem-customer-id"],
					$_POST["problem-id"]
				);
			}
			
			elseif (isset($_POST['resolveButton'])) {
				ProblemModel::resolve($_POST["problem-id"]);
			}

			header("Location: /UpdateProblem?id=".$_POST["problem-id"]);
		}
	}
	

