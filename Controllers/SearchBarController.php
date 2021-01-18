<?php
	
	require_once __DIR__ . "/../Core/ControllerBase.php";
	require_once __DIR__ . "/../Core/ViewBase.php";
	require_once __DIR__ . "/../Models/SearchQueryModel.php";
	require_once __DIR__ . '/QueryPostController.php';
	
	class SearchBarController extends ControllerBase
	{
		
		function __construct()
		{
			$this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");
			
		}
		public function post(): void
		{

		}

		function get(): void
		{
			// SEARCH BAR RE-REQUEST
			//require_once ('../Views/SearchBarView.php');
			
			// ==========(Capture Search Request)=====================================|
			
			// USER INPUT CAPTURE AND STORAGE
			// Each element has to be checked and stored before hand,
			// the check is to see if anything has been captured
			// to avoid errors.
			
			// User String Input.
			if (isset($_GET['searchBar']))
			{
				$this->view->searchLine = $_GET['searchBar'];
			}
			else
			{
				$this->view->searchLine = "";
			}
			
			// Radio Button Input
			if (isset($_GET['searchRadio']))
			{
				$this->view->searchRequest = $_GET['searchRadio'];
			}
			else
			{
				$this->view->searchRequest = "1";
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
				$searchResolvedStatus = "0";
			}

            // Dropdown - Urgency
            if (isset($_GET['urgencyDropdown']))
            {
                $searchUrgencySelection = $_GET['urgencyDropdown'];
            }
            else
            {
                $searchUrgencySelection = "high";
            }

			$searchQueryModel = new SearchQueryModel($searchResolvedStatus, $this->view->searchRequest, $this->view->searchLine, $searchUrgencySelection);
			$searchQueryModel->searchBarQuery();
			
			// The model used with the search bar is called, see the model
			// for further information.
			// require_once __DIR__ . '/../Models/SearchQueryModel.php';
			
			// ==========(Posting Queries)=====================================|
			
			// Grabs the controller that packages the search responses ready for viewing by the user.

			// TODO: THESE might not be needed.
			//$queryPostController = new QueryPostController($searchQueryModel->getDataset(), $searchRequest);
			//$queryPostController->queryPostController();
			
			$view = new stdClass();
			$view->dataset = $searchQueryModel->getDataset();
			
			$this->view->dataset = $searchQueryModel->getDataset();
			$this->view->view();
		}

	}

?>
