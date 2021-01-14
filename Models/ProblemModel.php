<?php
	
	require_once 'Models/DatabaseModel.php';
	
	class ProblemModel
	{
		protected $id, $urgency, $description, $resolved, $category_id, $staff_uploader, $customer_id, $placeholder, $category;
		
		public function __construct($id, $urgency, $description, $resolved, $category_id, $staff_uploader, $customer_id, $placeholder, $category)
		{
			$this->id = $id;
			$this->urgency = $urgency;
			$this->description = $description;
            $this->resolved = $resolved;
			$this->category_id = $category_id;
			$this->staff_uploader = $staff_uploader;
			$this->customer_id = $customer_id;
            $this->placeholder = $placeholder;
            $this->category = $category;
		}

		public static function fetchActiveProblems() : array
        {
            $db = DatabaseModel::getInstance();

            $add_problem = $db->getDBConnection()->prepare("SELECT * FROM problems JOIN categorisation ON problems.categorisation_id = categorisation.id WHERE resolved = FALSE");
            $add_problem->bind_result($id, $urgency, $description, $resolved, $category_id, $staff_uploader, $customer_id, $placeholder, $category);
            $add_problem->execute();
            $problemSet = [];
            while($add_problem->fetch()) {
                array_push($problemSet, new ProblemModel($id, $urgency, $description, $resolved, $category_id, $staff_uploader, $customer_id, $placeholder, $category));
            }
            $add_problem->close();

            return $problemSet;
        }
		
		public static function add_problem($urgency, $description, $categorisation_id, $staff_id, $customer_id)
		{
			$db = DatabaseModel::getInstance();
			
			$add_problem = $db->getDBConnection()->prepare("INSERT INTO problems (urgency, Description, categorisation_id, staff_uploader, customer_id) VALUES (?,?,?,?,?);");
			$add_problem->bind_param("ssiii", $urgency,$description, $categorisation_id, $staff_id, $customer_id);
			$add_problem->execute();
			$add_problem->fetch();

            $add_problem->close();
		}

        public function getID() {
            return $this->id;
        }

        public function getUrgency() {
            return $this->urgency;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getCategoryID() {
            return $this->category_id;
        }

        public function getStaffUploader() {
            return $this->staff_uploader;
        }

        public function getCustomerID() {
            return $this->customer_id;
        }

        public function getCategory() {
            return $this->category;
        }

        public function getResolved() {
		    return $this->resolved;
        }
	}