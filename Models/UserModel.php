<?php
	class UserModel
	{
		public $id;
		public $name;
		public $email;
		
		function __construct($id, $name, $email) {
			$this->id = $id;
			$this->name = $name;
			$this->email= $email;
		}
	}