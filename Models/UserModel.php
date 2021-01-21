<?php
	
	class UserModel
	{
		public int $id;
		public string $name;
		public string $email;
		public int $permissions;
		
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

        static function addNewUser($name, $password, $email, $permissions)
        {
            $db = DatabaseModel::getInstance();

            $add_problem = $db->getDBConnection()->prepare("INSERT INTO staff (name, password, email, permissions) VALUES (?,?,?,?);");
            $add_problem->bind_param("ssss", $name, $password, $email, $permissions);
            $add_problem->execute();

            $add_problem->fetch();

            $add_problem->close();
        }

        static function checkAdmin($user)
        {
            return !!($user->getPermissions() & 1);
        }

        static function checkTeamLeader($user)
        {
            return !!($user->getPermissions() & 2);
        }
	}