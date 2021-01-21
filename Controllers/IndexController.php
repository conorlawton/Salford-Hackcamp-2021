<?php
	
	require_once "Models/UserModel.php";
	require_once "Core/ControllerBase.php";
	require_once "Core/ViewBase.php";
	require_once "Models/ProblemModel.php";
	
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
			
			$this->view->problem_data_set = ProblemModel::fetch_active_problems();

			usort($this->view->problem_data_set, function($a, $b) {
				return $a < $b;
			});
			
			$this->view->view();
		}
		
		function post(): void
		{
		
		}
	}