<?php

// Grab the database basic model.
	require_once __DIR__ . "/DatabaseModel.php";
	require_once __DIR__ . "/SearchObjects/CustomerSearchModel.php";
    require_once __DIR__ . "/SearchObjects/ProblemSearchModel.php";
    require_once __DIR__ . "/SearchObjects/CategorySearchModel.php";
    require_once __DIR__ . "/SearchObjects/StaffSearchModel.php";
    require_once __DIR__ . "/SearchObjects/CustomerSearchModel.php";
	
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
		
		function get(): void
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


			
			// The switch statement initially checks for which radio button filter has been selected,
			// then it decided if the 'resolved' status is true or false,
			// this determines the SQL statement that is chosen.
			switch ($this->searchRequest)
			{
				
				// ======(Search for specific Customer and their associated queries.)===================================
				case "1":
                {

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

                    // Prepares the SQL statement and puts it into the variable $sqlQuery.
                    $sqlQuery = $database->getDBConnection()->prepare("SELECT * 
                                                                             FROM customers
                                                                             WHERE customers.firstName LIKE ?
                                                                             AND customers.lastName LIKE ?");

                    // Adds the % symbols to aid the SQL LIKE keyword.
                    $chopFirstName = "%" . $chopFirstName . "%";
                    $chopLastName = "%" . $chopLastName . "%";

                    // Binds the result, every attribute coming back from the database must be stated here, even if it is not used.
                    $sqlQuery->bind_result($customerID, $CustomerFirstName, $CustomerLastName, $CustomerEmail, $CustomerPhoneNumber);

                    // Here both of the variables used in the SQL statement are defined, represented in the statement as '?'.
                    $sqlQuery->bind_param("ss", $chopFirstName, $chopLastName);

                    // The statement is executed.
                    $sqlQuery->execute();

                    // Here each row is fetched and the desired attributes are fed into an object that represents this search.
                    while ($sqlQuery->fetch())
                    {

                        array_push($this->dataset, new CustomerSearchModel($customerID, $CustomerFirstName, $CustomerLastName, $CustomerEmail, $CustomerPhoneNumber));

                    }

                    // The SQL query is cleared.
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


