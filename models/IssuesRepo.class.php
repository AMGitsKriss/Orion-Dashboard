<?php
class IssuesRepo extends KConnect{

	/*
		This class is now moot, as the ISsues functionality was abandoned. 
		It remains an an example of database integration.
	*/

	// Overriding
	private $sql = [
			"getIssuesByUsername" => "CALL getIssuesByUsername(?)",
			"getIssuesByUsernameProjectId" => "CALL getIssuesByUsernameProjectId(?, ?)"
		];

	function __construct($servername, $dbname, $username, $password){
		// Grab KConnect - connect to the DB.
		parent::__construct($servername, $dbname, $username, $password, $this->sql);
	}

	public function getIssues($username){
		// Query the server
		$statement = $this->query("getIssuesByUsername", $username);
		$returnList = [];

		// Iterate over the results and build an appropriate object.
		while($value = $statement->fetch(PDO::FETCH_ASSOC)){
			// TODO - build a list of IssueView objects
			array_push($returnList, $value);
		}

		return $returnList;
	}
}
?>