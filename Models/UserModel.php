<?php
	
	class UserModel
	{
	    //Temporary merge branch 1
		public $id;
		public $name;
		public $email;
		public $permissions;
		//public int $id;
		//public string $name;
		//public string $email;
        //Temporary merge branch 2
		
		function __construct($id, $name, $email, $permissions) {
			$this->id = $id;
			$this->name = $name;
			$this->email= $email;
            $this->permissions= $permissions;
			$this->permissions = $permissions;
		}

		static function get_by_id(int $_id): ?UserModel {
			$db = DatabaseModel::getInstance();

			$get_by_id = $db->getDBConnection()->prepare("SELECT id, name, email, permissions FROM staff WHERE id = ?;");
			$get_by_id->bind_param("i", $_id);
			$get_by_id->bind_result($id, $name, $email, $permissions);
			$get_by_id->execute();

			if ($get_by_id->fetch()) {
				$get_by_id->close();
				return new UserModel($id, $name, $email, $permissions);
			} else {
				$get_by_id->close();
				return null;
			}
		}

		function getPermissions()
        {
            return $this->permissions;
        }
	}