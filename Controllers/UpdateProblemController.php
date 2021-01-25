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


			if (isset($_GET['problemID']))
            {
                $_SESSION['problemID'] = $_GET['problemID'];
            }


			$this->view->problem = ProblemModel::get_by_id( $_SESSION['problemID']);
		}
		
		function get(): void
		{
			$this->view->view();
		}
		
		function post(): void
		{
			if (isset($_POST['submitBTN']))
			{
			    echo ("Got here");

				ProblemModel::update_problem($this->view->problem->urgency, $this->view->problem->description, $this->view->problem->category_id,$this->view->problem->customer_id, $this->view->problem->id );
				
				if (isset($_POST['description']) && $_POST['description'] && $_POST['description'] != $this->view->problem->description )
				{
					$this->view->problem->description = $_POST['description'];
				}
				
				if (  isset($_POST['urgency']) && $_POST['urgency'] != $this->view->problem->urgency)
				{
					$this->view->problem->urgency = $_GET['urgency'];
				}
				
				if (isset($_POST['categorisation_id']) && $_POST['categorisation_id'] != $this->view->problem->category_id )
				{
					$this->view->problem->category_id = $_POST['categorisation_id'];
				}
				
				if (isset($_POST['CustomerID']) && $_POST['CustomerID'] != $this->view->problem->customer_id)
				{
					$this->view->problem->customer_id = $_POST['CustomerID'];
				}
			}
			elseif (isset($_POST['resolveButton'])) {
				ProblemModel::resolve($this->view->problem->id);
			}

            header("Location: /UpdateProblem");

		}
	}
	

