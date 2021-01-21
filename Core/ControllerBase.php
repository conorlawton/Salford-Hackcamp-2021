<?php
	
	
	abstract class ControllerBase
	{
		/**
		 * @var ViewBase
		 */
		public $view;
		
		public abstract function get();
		public abstract function post();
	}