<?php
	
	require_once 'Models/DatabaseModel.php';
	require_once 'Core/Widget.php';
	
	class ProblemModel extends Widget
	{
		public int $id;
		public string $urgency;
		public string $description;
		public int $resolved;
		public int $category_id;
		public int $staff_id;
		public int $customer_id;
		public DateTime $time_stamp;
		
		public function __construct($id, $urgency, $description, $resolved, $category_id, $staff_id, $customer_id, $time_stamp)
		{
			$this->id = $id;
			$this->urgency = $urgency;
			$this->description = $description;
			$this->resolved = $resolved;
			$this->category_id = $category_id;
			$this->staff_id = $staff_id;
			$this->customer_id = $customer_id;
			$this->time_stamp = $time_stamp;
		}
		
		public static function fetch_active_problems(): array
		{
			$db = DatabaseModel::getInstance();
			
			$add_problem = $db->getDBConnection()->prepare("SELECT * FROM problems WHERE resolved = FALSE");
			$add_problem->bind_result($id, $urgency, $description, $resolved, $category_id, $staff_id, $customer_id, $time_stamp);
			$add_problem->execute();
			$add_problem->store_result();
			
			$problemSet = [];
			
			while ($add_problem->fetch())
			{
				$new_problem = new ProblemModel($id, $urgency, $description, $resolved, $category_id, $staff_id, $customer_id, DateTime::createFromFormat("Y-m-d H:i:s", $time_stamp));
				array_push($problemSet, $new_problem);
			}
			
			$add_problem->close();
			
			return $problemSet;
		}
		
		public static function insert_problem($urgency, $description, $categorisation_id, $staff_id, $customer_id)
		{
			$db = DatabaseModel::getInstance();
			
			$add_problem = $db->getDBConnection()->prepare("INSERT INTO problems (urgency, description, category_id, staff_id, customer_id) VALUES (?,?,?,?,?);");
			$add_problem->bind_param("ssiii", $urgency, $description, $categorisation_id, $staff_id, $customer_id);
			$add_problem->execute();
			
			$add_problem->fetch();
			
			$add_problem->close();
		}
		
		public static function check_if_exists($id): ?bool {
			
			$db = DatabaseModel::getInstance();
			
			$check_exists = $db->getDBConnection()->prepare("SELECT 1 FROM problems WHERE id = ?;");
			$check_exists->bind_param("i", $id);
			$check_exists->execute();
			
			$result = $check_exists->fetch();
			
			$check_exists->close();
			
			return $result;
		}
		
		public static function get_by_id($id): ?ProblemModel {
			
			$db = DatabaseModel::getInstance();
			
			$get_by_id = $db->getDBConnection()->prepare("SELECT * FROM problems WHERE id = ? LIMIT 1;");
			$get_by_id->bind_param("i", $id);
			$get_by_id->bind_result($id, $urgency, $description, $resolved, $category_id, $staff_id, $customer_id, $time_stamp);
			$get_by_id->execute();
			
			if($get_by_id->fetch()) {
				$get_by_id->close();
				return new ProblemModel($id, $urgency, $description, $resolved, $category_id, $staff_id, $customer_id, DateTime::createFromFormat("Y-m-d H:i:s", $time_stamp));
			} else {
				$get_by_id->close();
				return null;
			}
		}
		
		public function display(): void
		{
			$problem = $this;
			require $_SERVER['DOCUMENT_ROOT'] . '/Views/Templates/ProblemModelView.phtml';
		}
	}