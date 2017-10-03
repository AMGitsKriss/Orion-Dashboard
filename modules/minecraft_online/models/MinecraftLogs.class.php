<?php

class MinecraftLocs{

	CON_JOIN = "[Server thread/INFO]: (\w+) joined the game"
	CON_LEAVE = "[Server thread/INFO]: (\w+) left the game";

	CON_JOIN_DETAIL = "[Server thread/INFO]: (\w+) logged in with entity id (\w+) at";
	CON_LEAVE_DETAIL = "[Server thread/INFO]: (\w+) lost connection:";

	CON_UUID = "[User Authenticator #8/INFO]: UUID of player (\w+) is";

	WARN_ENTITY = "[Server thread/WARN]: Keeping entity";
	WARN_RESOURCES = "[Server thread/WARN]: Can't keep up! Did the system time change, or is the server overloaded?";

	$database;

	//Initialise the class using my external database handler. 
	function __construst(KConnect $db){
		$this->database = $db;
	}

	//Initialise the class using it's built in database functionality.
	function __construct($data){
		try{
			$this->database = new KConnect($data["servername"], $data["dbname"], $data["username"], $data["password"]);
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	function getCategory($string){

		if(preg_match(CON_JOIN, $string)){
			return "CON_JOIN";
		}

		if(preg_match(CON_LEAVE, $string)){
			return "CON_LEAVE";
		}

		if(preg_match(CON_JOIN_DETAIL, $string)){
			return "CON_JOIN_DETAIL";
		}

		if(preg_match(CON_LEAVE_DETAIL, $string)){
			return "CON_LEAVE_DETAIL";
		}

		if(preg_match(CON_UUID, $string)){
			return "CON_UUID";
		}

		if(preg_match(WARN_ENTITY, $string)){
			return "WARN_ENTITY";
		}

		if(preg_match(WARN_RESOURCES, $string)){
			return "WARN_RESOURCES";
		}	
	}
}

class KConnect {

	//Defining the Database Connection and Tables list.
	private $conn;

	private $sql = [
		"selectUser" => "SELECT * FROM users WHERE username=?"
	];

	//Initialise the connection.
	function __construct($servername, $dbname, $username, $password){
		try{
			$this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		}
		catch (Exception $e){
			print "<p>Database Connection Derp: " . $e->getMessage() . "</p>";
			die();
		}
	}

	function makeStatement($sql, $data = null){
		$statement = $this->conn->prepare( $sql );
		try{
			if($statement->execute($data)){
				return $statement;
			}
			else{
				return $statement->errorInfo()[2];
			}
		}
		catch(Exception $e){
			//spit back an error
			$msg = "<p>You tried to run this sql: $entrySQL<p>\n<p>Exception: $e</p>";
			trigger_error($msg);
		}
		return null;
	}

	//Returns all entries of a named table. 
	//Should not be called in regular use.
	function getAll($table){
		$sql = "SELECT * FROM $table";

		$statement = $this->makeStatement($sql);
		
		$returnList = [];

		print_r("<p>Uuh.. ".$statement."</p>");

		//Get each row as "$value" and add it to the "$returnList" array.
		while($value = $statement->fetch(PDO::FETCH_ASSOC)){
			array_push($returnList, $value);
		}
		return $returnList;
	}

	function getByOrder($table){
		$sql = "SELECT * FROM $table ORDER BY display_order";

		$statement = $this->makeStatement($sql);
		
		$returnList = [];

		//Get each row as "$value" and add it to the "$returnList" array.
		while($value = $statement->fetch(PDO::FETCH_ASSOC)){
			array_push($returnList, $value);
		}
		return $returnList;
	}

	function query(){
		//First element is the sql key. The rest are arguments.
		$data = func_get_args();
		$key = array_shift($data);

		$statement = $this->makeStatement($this->sql[$key], $data);

		// This will either be an error string, or results.
		return $statement;
	}
}

?>