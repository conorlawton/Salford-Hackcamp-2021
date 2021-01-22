<?php
	
	require_once "Core/ViewBase.php";
	require_once "Core/ControllerBase.php";
	require_once "Models/AuditModel.php";
	
	class AuditTrailController extends ControllerBase
	{
		private $user;
		
		function __construct($user)
		{
			$this->user = $user;
			$this->view = new ViewBase("Audit Trail", "/Views/AuditTrailView.phtml");
		}
		
		function get(): void
		{
			$p = 0;
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] >= 0) {
				$p = $_GET["page"];
			}
			
			$this->view->results = AuditModel::fetch_n_most_recent_with_offset(25, $p * 25);
			$this->view->p = $p;
			
			$max = AuditModel::count();
			$mp = ceil($max / 25);
			$this->view->mp = $mp;
			$this->view->max = $max;
			if (!is_numeric($p) || $p < 0) {
				header("Location: /auditTrail?page=0");
				die();
			} else if (floor($p) != $p) {
				$p = floor($p);
				header("Location: /auditTrail?page=$p");
			} else if ($p > $mp) {
				header("Location: /auditTrail?page=$mp");
				die();
			} else {
				$this->view->view();
			}
		}
		
		function post(): void
		{
		
		}
	}