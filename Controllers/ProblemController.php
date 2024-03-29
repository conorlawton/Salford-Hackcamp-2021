<?php
	
	require_once "Core/ControllerBase.php";
	require_once "Core/ViewBase.php";
	require_once "Models/CommentModel.php";
	require_once "CommentController.php";
	
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
				//$_SESSION["new_comments_check"][$id] = true;
				
				if (!is_null($problem))
				{
					$this->view->problem = $problem;
					$this->view->current_comments = CommentModel::get_all_on_problem($id);
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
	