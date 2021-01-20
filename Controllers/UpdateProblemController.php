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

		}
	}
	

