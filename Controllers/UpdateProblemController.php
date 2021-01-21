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
			$this->view->ID = $_GET['problemID'];
			$this->view->problem = ProblemModel::get_by_id($this->view->ID);
		}
		
		function get(): void
		{
			$this->view->view();
		}
		
		function post(): void
		{
			if (isset($_GET['submitBTN']))
			{
				ProblemModel::update_problem($view->problem->urgency, $view->problem->description, $view->problem->category_id,$view->problem->customer_id, $view->problem->id );
				
				if (isset($_GET['description']) && $_GET['description'] && $_GET['description'] != $view->problem->description )
				{
					$view->problem->description = $_GET['description'];
				}
				
				if (  isset($_GET['urgency']) && $_GET['urgency'] != $view->problem->urgency)
				{
					$view->problem->urgency = $_GET['urgency'];
				}
				
				if (isset($_GET['categorisation_id']) && $_GET['categorisation_id'] != $view->problem->category_id )
				{
					$view->problem->category_id = $_GET['categorisation_id'];
				}
				
				if (isset($_GET['CustomerID']) && $_GET['CustomerID'] != $view->problem->customer_id)
				{
					$view->problem->customer_id = $_GET['CustomerID'];
				}
			}
			elseif (isset($_GET['resolveButton'])) {
				ProblemModel::resolve($view->problem->id);
			}
		}
	}
	

