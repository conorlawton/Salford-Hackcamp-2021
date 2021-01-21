<?php
	
	require_once "Core/ControllerBase.php";
	require_once "Models/CommentModel.php";
	
	class CommentController extends ControllerBase
	{
		public function get()
		{
			if (isset($_GET["problem_id"]) && is_numeric($_GET["problem_id"]) && $_GET["problem_id"] > 0)
			{
				$problem_id = $_GET["problem_id"];
				if (isset($_GET["new_comments"]) && isset($_GET["now"]))
				{
					$problem_exists = ProblemModel::check_if_exists($problem_id);
					if ($problem_exists === true)
					{
						//if (isset($_SESSION["new_comments_check"][$problem_id]) && $_SESSION["new_comments_check"][$problem_id]) {
							$comments = CommentModel::get_comments_after(DateTime::createFromFormat("Y-m-d H:i:s", $_GET["now"]), $problem_id);
							$_SESSION["new_comments_check"][$problem_id] = false;
							
							if (empty($comments))
							{
								http_response_code(204);
							} else {
								
								ob_start();
								
								foreach ($comments as $comment)
								{
									$comment->display();
								}
								
								echo ob_get_clean();
								
								http_response_code(200);
							}
						} else {
							http_response_code(204);
						}
					/*}
					else
					{
						http_response_code(404);
					}*/
				}
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
				
				//$_SESSION["new_comments_check"][$_POST["problem_id"]] = true;
				
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