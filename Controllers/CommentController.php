<?php
	
	require_once "Core/ControllerBase.php";
	require_once "Models/CommentModel.php";
	
	class CommentController extends ControllerBase
	{
		
		public function get()
		{
			if (isset($_GET["problem_id"]) && is_numeric($_GET["problem_id"]) && $_GET["problem_id"] > 0)
			{
				if (isset($_GET["new_comments"]) && isset($_GET["now"]))
				{
					$problem_exists = ProblemModel::check_if_exists($_GET["problem_id"]);
					if ($problem_exists === true)
					{
						$comments = CommentModel::get_comments_after(DateTime::createFromFormat("Y-m-d H:i:s", $_GET["now"]), $_GET["problem_id"]);
						
						if (empty($comments))
						{
							http_response_code(204);
							die();
						}
						
						ob_start();
						
						foreach ($comments as $comment)
						{
							$comment->display();
						}
						
						$flush = ob_get_clean();
						
						echo $flush;
						
						http_response_code(200);
					}
					else
					{
						http_response_code(400);
					}
				}
				/*else
				{
					$problem_exists = ProblemModel::check_if_exists($_GET["problem_id"]);
					if ($problem_exists === true)
					{
						$comments = CommentModel::get_all_on_problem($_GET["problem_id"]);
					}
					else
					{
						if ($problem_exists === null)
						{
							$_SESSION["get_comments_message"] = "Problem with that ID does not exist";
						}
						else
						{
							$_SESSION["get_comments_message"] = "Unknown error.";
						}
					}
				}*/
			}
			else
			{
				http_response_code(400);
			}
		}
		
		public function post()
		{
			if (isset($_POST["add_comment"]))
			{
				
				$staff = $_SESSION["user"];
				$comment = CommentModel::insert_new($_SESSION["user"]->id, htmlspecialchars($_POST["comment_text"]), $_POST["problem_id"]);
				
				ob_start();
				$comment->display();
				
				echo ob_get_clean();
				
				http_response_code(200);
			}
			else
			{
				http_response_code(400);
			}
		}
	}