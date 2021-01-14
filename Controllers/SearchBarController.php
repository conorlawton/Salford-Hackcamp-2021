<?php
	
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
    require_once __DIR__ . "/../Models/SearchQueryModel.php";
	
	class SearchBarController extends ControllerBase
	{
		
		function __construct()
		{
			$this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");

		}
        function view(): void
        {
            $this->view->view();
        }

		
		public function searchBarInput()
		{
			// SEARCH BAR RE-REQUEST
			//require_once ('../Views/SearchBarView.php');

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
            else
            {

                $searchLine = "";

            }
			
			// Radio Button Input
			if (isset($_POST['searchRadio']))
			{
				
				$searchRequest = $_POST['searchRadio'];
				
			}
            else
            {

                $searchRequest = "1";

            }
			
			// Default initialisation.
			$searchResolvedStatus = 0;
			
			// Checkbox
			if (isset($_POST['searchCheckbox']))
			{
				
				$searchResolvedStatus = $_POST['searchCheckbox'];
				
			}
			else
            {

                $searchResolvedStatus = "1";

            }

			$searchQueryModel = new SearchQueryModel($searchResolvedStatus, $searchRequest,$searchLine);
            $searchQueryModel->searchBarQuery();

			// The model used with the search bar is called, see the model
			// for further information.
			// require_once __DIR__ . '/../Models/SearchQueryModel.php';
			
			// ==========(Posting Queries)=====================================|

			// Grabs the controller that packages the search responses ready for viewing by the user.
			require_once __DIR__ . '/QueryPostController.php';

			$queryPostController = new QueryPostController($searchQueryModel->getDataset(), $searchRequest);
            $queryPostController->queryPostController();

            $view = new stdClass();
            $view->dataset = $searchQueryModel->getDataset();

            $this->view->dataset = $searchQueryModel->getDataset();

           // require_once  __DIR__ . "/../Views/SearchBarView.phtml";


		}


		
	}


	
	$searchBar = new SearchBarController();
	$searchBar->searchBarInput();
	
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
