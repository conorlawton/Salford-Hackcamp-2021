<?php
	
	require_once __DIR__ . "/../Models/UserModel.php";
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
	require_once __DIR__ . "/../Models/ProblemModel.php";
	
	class IndexController extends ControllerBase
	{
		private $user;
		
		function __construct($user)
		{
			$this->user = $user;
			$this->view = new ViewBase("Home", "/Views/IndexView.phtml");
		}
		
		function get(): void
		{
			
			$this->view->problem_data_set = ProblemModel::fetchActiveProblems();
			$this->view->view();
		}
		
		function post(): void
		{
		
		}
	}