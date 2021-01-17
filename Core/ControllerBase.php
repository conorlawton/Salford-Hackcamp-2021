<?php
	
	
	abstract class ControllerBase
	{
		/**
		 * @var ViewBase
		 */
		public $view;
		
		public abstract function get(): void;
		public abstract function post(): void;
	}