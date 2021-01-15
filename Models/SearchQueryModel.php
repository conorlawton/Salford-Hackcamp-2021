<?php

// Grab the database basic model.
	require_once __DIR__ . "/DatabaseModel.php";
	require_once __DIR__ . "/SearchObjects/CustomerSearchModel.php";
    require_once __DIR__ . "/SearchObjects/ProblemSearchModel.php";
    require_once __DIR__ . "/SearchObjects/CategorySearchModel.php";
    require_once __DIR__ . "/SearchObjects/StaffSearchModel.php";
	
	class SearchQueryModel
	{
		
		// Variable Calls
		private $searchResolvedStatus;
		private $searchRequest;
		private $searchLine;
		private $urgency;
		private $dataset = [];
		
		function __construct($resolved, $request, $line, $urgencyParam)
		{
			$this->view = new ViewBase("Home", "/Views/SearchBarView.phtml");
			
			$this->searchResolvedStatus = $resolved;
			$this->searchRequest = $request;
			$this->searchLine = $line;
			$this->urgency = $urgencyParam;
			
		}
		
		function view(): void
		{
			$this->view->view();
		}
		
		public function getDataset()
		{
			
			return $this->dataset;
			
		}
		
		public function searchBarQuery()
		{
			
			// Initialise a database basic model object.
			$database = DatabaseModel::getInstance();

			// These IF ELSE statements handle the string needed for the customer search section,
            // here the string is split up to be useable for the database.
			$nameArray = explode(" ", $this->searchLine);
			
			if (isset($nameArray[0]))
			{
				$chopFirstName = $nameArray[0];
			}
			else
			{
				$chopFirstName = "";
			}
			
			if (isset($nameArray[1]))
			{
				$chopLastName = $nameArray[1];
			}
			else
			{
				$chopLastName = "";
			}
			
			// The switch statement initially checks for which radio button filter has been selected,
			// then it decided if the 'resolved' status is true or false,
			// this determines the SQL statement that is chosen.
			switch ($this->searchRequest)
			{
				
				// ======(Search for specific Customer and their associated queries.)===================================
				case "1":
                {

                    $sqlQuery = $database->getDBConnection()->prepare("SELECT * FROM customers WHERE firstName LIKE ? AND lastName LIKE ?");

                    $sqlQuery->bind_result($id, $firstName, $lastName, $email, $phoneNumber);
                    $sqlQuery->bind_param("ss", $chopFirstName, $chopLastName);
                    $sqlQuery->execute();

                    while ($sqlQuery->fetch())
                    {

                        array_push($this->dataset, new CustomerSearchModel($id, $firstName, $lastName, $email, $phoneNumber));

                    }

                    $sqlQuery->close();

                    break;

                }
				
				// ======(Search for queries based on their description.)===============================================
				case "2":
                {

                    // Actual Construction;
                    $sqlQuery = $database->getDBConnection()->prepare("SELECT * FROM problems WHERE description LIKE ? AND urgency LIKE ? AND resolved = ?;");

                    $searchLine = "%$this->searchLine%";
                    $urgency = "%$this->urgency%";

                    $sqlQuery->bind_result($id, $urgency, $description, $resolved, $categoryID, $staffUploader, $userID);
                    $sqlQuery->bind_param("ssi", $searchLine, $urgency, $this->searchResolvedStatus);
                    $sqlQuery->execute();

                    while ($sqlQuery->fetch())
                    {

                        array_push($this->dataset, new ProblemSearchModel($id, $urgency, $description, $resolved, $categoryID, $staffUploader, $userID));

                    }

                    $sqlQuery->close();

                    break;

                }
				
				// ======(Search for all queries in a specific Category.)===============================================
				case "3":
                {

                    //

                }
				
				// ======(Search for all queries associated with a specific member of Staff.)===========================
				case "4":
                {

                    //

                }
				
			}

// Database handling
// $statement = $database->getDBConnection()->prepare($sqlQuery);
		
		}
		
	}


