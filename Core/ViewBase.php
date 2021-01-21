<?php
	
	class ViewBase
	{
		public $title, $body;
		
		public function __construct($title, $body)
		{
			$this->title = $title;
			$this->body = $_SERVER["DOCUMENT_ROOT"] . $body;
		}
		
		public function view() {
			$view = $this;
			require_once $_SERVER["DOCUMENT_ROOT"] . "/Views/Main.php";
		}
	}