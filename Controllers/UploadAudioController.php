<?php
	
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
	
	class UploadAudioController extends ControllerBase {
		
		function __construct() {
			$this->view = new ViewBase("Upload Audio", "/Views/UploadAudioView.phtml");
		}
		
		function get(): void {
			$this->view->view();
		}
	}