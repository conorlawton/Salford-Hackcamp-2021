<?php
	
	require_once "Core/ControllerBase.php";
	require_once "Core/ViewBase.php";
	require_once "Models/SearchQueryModel.php";
	require_once 'QueryPostController.php';
	
	class SearchBarController extends ControllerBase
	{
		
		function __construct()
		{
			$this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");
			
		}
		
		function get(): void
		{
			// SEARCH BAR RE-REQUEST
			//require_once ('../Views/SearchBarView.php');
			
			// ==========(Capture Search Request)=====================================|
			
			// USER INPUT CAPTURE AND STORAGE
			// Each element has to be checked and stored befornd,
			// the check is to see if anything has been captured
			// to avoid errors.
			
			// User String Input.
			if (isset($_GET['searchBar']))
			{
				$searchLine = $_GET['searchBar'];
			}
			else
			{
				$searchLine = "";
			}
			
			// Radio Button Input
			if (isset($_GET['searchRadio']))
			{
				$searchRequest = $_GET['searchRadio'];
			}
			else
			{
				$searchRequest = "1";
			}
			
			// Default initialisation.
			$searchResolvedStatus = 0;
			
			// Checkbox
			if (isset($_GET['searchCheckbox']))
			{
				$searchResolvedStatus = $_GET['searchCheckbox'];
			}
			else
			{
				$searchResolvedStatus = "1";
			}
			
			$searchQueryModel = new SearchQueryModel($searchResolvedStatus, $searchRequest, $searchLine);
			$searchQueryModel->searchBarQuery();
			
			// The model used with the search bar is called, see the model
			// for further information.
			// require_once __DIR__ . '/../Models/SearchQueryModel.php';
			
			// ==========(Posting Queries)=====================================|
			
			// Grabs the controller that packages the search responses ready for viewing by the user.
			
			$queryPostController = new QueryPostController($searchQueryModel->getDataset(), $searchRequest);
			$queryPostController->queryPostController();
			
			$view = new stdClass();
			$view->dataset = $searchQueryModel->getDataset();
			
			$this->view->dataset = $searchQueryModel->getDataset();
			
			$this->view->view();
		}
		
		function post(): void
		{
		
		}
	}
	
	/*
	
	echo "Test";
	// HEADER
	require_once ('../Views/Templates/head.phtml');
	
	// SEARCH BAR RE-REQUEST
	require_once ('../Views/search_bar_view.php');
	
	// ==========(Capture Search Request)=====================================|
	
	// USER INPUT CAPTURE AND STORAGE
	// Each element has to be checked and stored before hand,
	// the check is to see if anything has been captured
	// to avoid errors.
	
	// User String Input.
	if (isset($_POST['searchBar']))
	{
	
			$searchLine = $_POST['searchBar'];
	
	}
	
	// Radio Button Input
	if (isset($_POST['searchRadio'])) {
	
			$searchRequest = $_POST['searchRadio'];
	
	}
	
	// Default initialisation.
	$searchResolvedStatus = 0;
	
	// Checkbox
	if (isset($_POST['searchCheckbox'])) {
	
			$searchResolvedStatus = $_POST['searchCheckbox'];
	
	}
	
	// The model used with the search bar is called, see the model
	// for further information.
	require_once __DIR__ . '/../Models/SearchQueryModel.php';
	
	// ==========(Posting Queries)=====================================|
	
	// Grabs the controller that packages the search responses ready for viewing by the user.
	require_once __DIR__ . '/QueryPostController.php';
	
	*/
