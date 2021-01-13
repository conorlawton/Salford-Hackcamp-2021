<?php
	
	require_once 'Models/DatabaseModel.php';
	
	class ProblemModel
	{
		protected $id, $urgency, $description, $category_id, $staff_uploader, $user_id;
		
		public function __construct($id, $urgency, $description, $category_id, $staff_uploader, $user_id)
		{
			$this->id = $id;
			$this->urgency = $urgency;
			$this->description = $description;
			$this->category_id = $category_id;
			$this->staff_uploader = $staff_uploader;
			$this->user_id = $user_id;
		}
		
		public static function add_problem($urgency, $description, $categorisation_id, $staff_id, $user_id)
		{
			$db = DatabaseModel::getInstance();
			
			$add_problem = $db->getDBConnection()->prepare("INSERT INTO problems (urgency, Description, categorisation_id, staff_uploader, user_id) VALUES (?,?,?,?,?);");
			$add_problem->bind_param("ssiii", $urgency,$description, $categorisation_id, $staff_id, $user_id);
			$add_problem->execute();
			$add_problem->fetch();
		}
	}