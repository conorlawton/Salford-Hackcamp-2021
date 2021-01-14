<?php
	
	
	abstract class ControllerBase
	{
		/**
		 * @var ViewBase
		 */
		public $view;
		
		public abstract function view(): void;
	}