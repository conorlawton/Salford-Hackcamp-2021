<?php
	
	class UserModel
	{
		public int $id;
		public string $name;
		public string $email;
		
		function __construct($id, $name, $email) {
			$this->id = $id;
			$this->name = $name;
			$this->email= $email;
		}
	}