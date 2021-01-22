<?php
	
	
	class LoginModel
	{
		private static array $logged_in;
		public int $id;
		public int $staff_id;
		public DateTime $start;
		public ?DateTime $end;
		
		public function __construct($id, $staff_id, $start, $end)
		{
			$this->id = $id;
			$this->staff_id = $staff_id;
			$this->start = $start;
			$this->end = $end;
		}
		
		public static function get_logged_in(): array
		{
			if (LoginModel::$logged_in === null)
			{
				LoginModel::$logged_in = [];
			}
			return LoginModel::$logged_in;
		}
		
		public static function get_by_id($_id)
		{
			$db = DatabaseModel::getInstance();
			
			$get_by_id = $db->getDBConnection()->prepare("SELECT * FROM logins WHERE id = ? LIMIT 1;");
			$get_by_id->bind_param("i", $_id);
			$get_by_id->bind_result($id, $staff_id, $start, $end);
			$get_by_id->execute();
			
			if ($get_by_id->fetch())
			{
				$get_by_id->close();
				return new LoginModel($id, $staff_id, DateTime::createFromFormat("Y-m-d H:i:s", $start), DateTime::createFromFormat("Y-m-d H:i:s", $end));
			}
			else
			{
				$get_by_id->close();
				return null;
			}
		}
	}