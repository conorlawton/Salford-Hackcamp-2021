<?php
	
	
	abstract class ControllerBase
	{
		/**
		 * @var ViewBase
		 */
		public $view;
		
		public abstract function get(): void;
		public function post(): void {}
	}