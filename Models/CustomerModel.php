<?php
	
	
	class CustomerModel
	{
		public int $id;
		public string $first_name;
		public string $last_name;
		public string $email;
		public string $phone_number;
		
		function __construct($id, $first_name, $last_name, $email, $phone_number)
		{
			$this->id = $id;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->email = $email;
			$this->phone_number = $phone_number;
		}
		
		static function check_if_exists($id): ?bool {
			
			$db = DatabaseModel::getInstance();
			
			$check_exists = $db->getDBConnection()->prepare("SELECT * FROM customers WHERE id = ? LIMIT 1;");
			$check_exists->bind_param("i", $id);
			$check_exists->execute();
			
			$result = $check_exists->fetch();
			
			$check_exists->close();
			
			return $result;
		}
	}
	