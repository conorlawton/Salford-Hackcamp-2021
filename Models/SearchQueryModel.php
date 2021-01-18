<?php

// Grab the database basic model.
	require_once __DIR__ . "/DatabaseModel.php";
	require_once __DIR__ . "/SearchObjects/CustomerSearchModel.php";
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
                    $sqlQuery = $database->getDBConnection()->prepare("SELECT 
                                                                             customers.*,
                                                                             COUNT(problems.id) as problem_count
                                                                         FROM
                                                                             customers
                                                                         LEFT JOIN problems ON customers.id = problems.customer_id
                                                                         WHERE customers.firstName LIKE ?
                                                                         AND customers.lastName LIKE ?
                                                                         GROUP BY customers.id, customers.firstName
                                                                         ORDER BY customers.id ASC;");

                    // Adds the % symbols to aid the SQL LIKE keyword.
                    $chopFirstName = "%" . $chopFirstName . "%";
                    $chopLastName = "%" . $chopLastName . "%";

                    // Binds the result, every attribute coming back from the database must be stated here, even if it is not used.
                    $sqlQuery->bind_result($customerID, $CustomerFirstName, $CustomerLastName, $CustomerEmail, $CustomerPhoneNumber, $queryCount);

                    // Here both of the variables used in the SQL statement are defined, represented in the statement as '?'.
                    $sqlQuery->bind_param("ss", $chopFirstName, $chopLastName);

                    // The statement is executed.
                    $sqlQuery->execute();

                    // Here each row is fetched and the desired attributes are fed into an object that represents this search.
                    while ($sqlQuery->fetch())
                    {

                        array_push($this->dataset, new CustomerSearchModel($customerID, $CustomerFirstName, $CustomerLastName, $CustomerEmail, $CustomerPhoneNumber, $queryCount));

                    }

                    // The SQL query is cleared.
                    $sqlQuery->close();

                    break;

                }
				
				// ======(Search for queries based on their description.)===============================================
				case "2":
                {

                    // Prepares the SQL statement and puts it into the variable $sqlQuery.
                    $sqlQuery = $database->getDBConnection()->prepare("SELECT problems.id, categorisation.category, problems.description, problems.urgency, problems.time_when_added, problems.resolved, staff.name
                                                                             FROM problems, categorisation, staff
                                                                             WHERE problems.staff_id = staff.id
                                                                             AND problems.category_id = categorisation.id
                                                                             AND problems.description LIKE ?
                                                                             AND problems.urgency LIKE ?
                                                                             AND problems.resolved = ?
                                                                             ORDER BY problems.id ASC;");

                    // Adds the % symbols to aid the SQL LIKE keyword.
                    $searchLine = "%" . $this->searchLine . "%";
                    $urgency = "%" . $this->urgency . "%";

                    // Binds the result, every attribute coming back from the database must be stated here, even if it is not used.
                    $sqlQuery->bind_result($problemID, $category, $description, $urgency, $addedTime, $resolved, $staffName);

                    // Here both of the variables used in the SQL statement are defined, represented in the statement as '?'.
                    $sqlQuery->bind_param("ssi", $searchLine, $urgency, $this->searchResolvedStatus);

                    // The statement is executed.
                    $sqlQuery->execute();

                    // Here each row is fetched and the desired attributes are fed into an object that represents this search.
                    while ($sqlQuery->fetch())
                    {

                        array_push($this->dataset, new GeneralProblemSearchModel($problemID, $category, $description, $urgency, $addedTime, $resolved, $staffName));

                    }

                    // The SQL query is cleared.
                    $sqlQuery->close();

                    break;

                }
				
				// ======(Search for all queries in a specific Category.)===============================================
				case "3":
                {

                    // Prepares the SQL statement and puts it into the variable $sqlQuery.
                    $sqlQuery = $database->getDBConnection()->prepare("SELECT problems.id, categorisation.category, problems.description, problems.urgency, problems.time_when_added, problems.resolved, staff.name
                                                                             FROM problems, categorisation, staff
                                                                             WHERE problems.staff_id = staff.id
                                                                             AND problems.category_id = categorisation.id
                                                                             AND categorisation.category LIKE ?
                                                                             ORDER BY problems.id ASC;");

                    // Adds the % symbols to aid the SQL LIKE keyword.
                    $searchLine = "%" . $this->searchLine . "%";

                    // Binds the result, every attribute coming back from the database must be stated here, even if it is not used.
                    $sqlQuery->bind_result($problemID, $category, $description, $urgency, $addedTime, $resolved, $staffName);

                    // Here both of the variables used in the SQL statement are defined, represented in the statement as '?'.
                    $sqlQuery->bind_param("s", $searchLine);

                    // The statement is executed.
                    $sqlQuery->execute();

                    // Here each row is fetched and the desired attributes are fed into an object that represents this search.
                    while ($sqlQuery->fetch())
                    {

                        array_push($this->dataset, new GeneralProblemSearchModel($problemID, $category, $description, $urgency, $addedTime, $resolved, $staffName));

                    }

                    // The SQL query is cleared.
                    $sqlQuery->close();

                    break;

                }
				
				// ======(Search for all queries associated with a specific member of Staff.)===========================
				case "4":
                {

                    // Prepares the SQL statement and puts it into the variable $sqlQuery.
                    $sqlQuery = $database->getDBConnection()->prepare("SELECT problems.id, categorisation.category, problems.description, problems.urgency, problems.time_when_added, problems.resolved, staff.name
                                                                             FROM problems, categorisation, staff
                                                                             WHERE problems.staff_id = staff.id
                                                                             AND problems.category_id = categorisation.id
                                                                             AND staff.name LIKE ?
                                                                             ORDER BY problems.id ASC;");

                    // Adds the % symbols to aid the SQL LIKE keyword.
                    $searchLine = "%" . $this->searchLine . "%";

                    // Binds the result, every attribute coming back from the database must be stated here, even if it is not used.
                    $sqlQuery->bind_result($problemID, $category, $description, $urgency, $addedTime, $resolved, $staffName);

                    // Here both of the variables used in the SQL statement are defined, represented in the statement as '?'.
                    $sqlQuery->bind_param("s", $searchLine);

                    // The statement is executed.
                    $sqlQuery->execute();

                    // Here each row is fetched and the desired attributes are fed into an object that represents this search.
                    while ($sqlQuery->fetch())
                    {

                        array_push($this->dataset, new GeneralProblemSearchModel($problemID, $category, $description, $urgency, $addedTime, $resolved, $staffName));

                    }

                    // The SQL query is cleared.
                    $sqlQuery->close();

                    break;

                }
				
			}

// Database handling
// $statement = $database->getDBConnection()->prepare($sqlQuery);
		
		}
		
	}


