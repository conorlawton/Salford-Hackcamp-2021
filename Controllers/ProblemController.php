<?php
	
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
	
	class ProblemController extends ControllerBase
	{
		
		function __construct()
		{
			$this->view = new ViewBase("Problems", "/Views/ProblemView.phtml");
		}
		
		public function get(): void
		{
			if (isset($_GET["id"]) && !empty($_GET["id"]))
			{
				$id = $_GET["id"];
				$problem = ProblemModel::get_by_id($id);
				
				if (!is_null($problem))
				{
					$this->view->problem = $problem;
					$this->view->view();
				}
				else
				{
					header("Location: /Error404");
				}
			}
			else
			{
				header("Location: /Error404");
			}
		}
		
		public function post(): void
		{
		
		}
	}
	