<?php
	
	require_once 'Core/Widget.php';
	
	class CommentModel extends Widget
	{
		public int $id;
		public int $staff_id;
		public string $text;
		public int $problem_id;
		public DateTime $time_stamp;
		
		function __construct($id, $staff_id, $text, $problem_id, $time_stamp)
		{
			$this->id = $id;
			$this->staff_id = $staff_id;
			$this->text = $text;
			$this->problem_id = $problem_id;
			$this->time_stamp = $time_stamp;
		}
		
		static function get_by_id($id)
		{
		
		}
		
		static function get_all_on_problem($problem_id): array
		{
			$db = DatabaseModel::getInstance();
			
			$insert_this = $db->getDBConnection()->prepare("SELECT * FROM comments WHERE problem_id = ?");
			$insert_this->bind_param("i", $problem_id);
			$insert_this->bind_result($id, $staff_id, $text, $problem_id, $time_stamp);
			$insert_this->execute();
			
			$comments = [];
			
			while ($insert_this->fetch())
			{
				$new_comment = new CommentModel($id, $staff_id, $text, $problem_id, DateTime::createFromFormat("Y-m-d H:i:s", $time_stamp));
				array_push($comments, $new_comment);
			}
			
			$insert_this->close();
			
			return $comments;
		}
		
		static function insert_new($staff_id, $text, $problem_id): ?CommentModel
		{
			$db = DatabaseModel::getInstance();
			
			$insert_new = $db->getDBConnection()->prepare("INSERT INTO comments (staff_id, text, problem_id) VALUES (?,?,?);");
			$insert_new->bind_param("isi", $staff_id, $text, $problem_id);
			$insert_new->execute();
			
			if ($insert_new->fetch())
			{
				return null;
			}
			
			$last_id = $insert_new->insert_id;
			
			$insert_new->close();
			
			$get_comment = $db->getDBConnection()->prepare("SELECT * FROM comments WHERE id = ? LIMIT 1;");
			$get_comment->bind_param("i", $last_id);
			$get_comment->bind_result($id, $staff_id, $text, $problem_id, $time_stamp);
			
			$get_comment->execute();
			
			if ($get_comment->fetch())
			{
				$get_comment->close();
				return new CommentModel($id, $staff_id, $text, $problem_id, DateTime::createFromFormat("Y-m-d H:i:s", $time_stamp));
			}
			else
			{
				$get_comment->close();
				return null;
			}
			
		}
		
		public static function get_comments_after(DateTime $time_stamp, int $_problem_id): array {
			
			$db = DatabaseModel::getInstance();
			
			$time_stamp_formatted = $time_stamp->format("Y-m-d H:i:s");
			
			$get_comments_after = $db->getDBConnection()->prepare("SELECT * FROM comments WHERE problem_id = ? AND time_stamp > ?;");
			$get_comments_after->bind_param("is", $_problem_id, $time_stamp_formatted);
			$get_comments_after->bind_result($id, $staff_id, $text, $problem_id, $time_stamp);
			
			$comments = [];
			
			$get_comments_after->execute();
			
			while ($get_comments_after->fetch())
			{
				$new_comment = new CommentModel($id, $staff_id, $text, $problem_id, DateTime::createFromFormat("Y-m-d H:i:s", $time_stamp));
				array_push($comments, $new_comment);
			}
			
			$get_comments_after->close();
			
			return $comments;
		}
		
		public static function get_number_of_comments(int $problem_id): int {
			$db = DatabaseModel::getInstance();
			
			$get_number_of_comments = $db->getDBConnection()->prepare("SELECT COUNT(id) FROM comments WHERE problem_id = ?;");
			$get_number_of_comments->bind_param("i", $problem_id);
			$get_number_of_comments->bind_result($num);
			
			$get_number_of_comments->execute();
			
			if ($get_number_of_comments->fetch())
			{
				$get_number_of_comments->close();
				return $num;
			}
			else
			{
				$get_number_of_comments->close();
				return 0;
			}
			
		}
		
		public function display(): void
		{
			$comment = $this;
			$staff = $_SESSION["user"];
			require $_SERVER["DOCUMENT_ROOT"] . "/Views/Templates/CommentModelView.phtml";
		}
	}