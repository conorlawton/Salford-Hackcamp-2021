<?php
	class UserModel
	{
		public $id;
		public $name;
		public $email;
		public $permissions;
		
		function __construct($id, $name, $email, $permissions) {
			$this->id = $id;
			$this->name = $name;
			$this->email= $email;
            $this->permissions= $permissions;
		}

		function getPermissions()
        {
            return $this->permissions;
        }
	}