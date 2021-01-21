<?php
	
	require_once "Models/UserModel.php";
	require_once "Core/ControllerBase.php";
	require_once "Core/ViewBase.php";
	require_once "Models/ProblemModel.php";
	
	class IndexController extends ControllerBase
	{
		function __construct()
		{
			$this->view = new ViewBase("Home", "/Views/IndexView.phtml");
		}
		
		function get(): void
		{
			
			$this->view->problem_data_set = ProblemModel::fetch_recent_problems(5);

			$this->view->view();
		}
		
		function post(): void
		{
		
		}
	}