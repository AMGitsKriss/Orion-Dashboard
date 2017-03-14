<?php
	class KConnect {

		//Defining the Database Connection and Tables list.
		private $conn;

		private $sql = [
			"selectUser" => "SELECT * FROM users WHERE username=?",
			"insertUser" => "INSERT INTO users (username, email, password) VALUES (?, ?, ?)",
			"selectMapShortcut" => "SELECT * FROM map_shortcuts WHERE name=?",
			"updateMapShortcut" => "INSERT INTO map_shortcuts (name, x_pos, z_pos, zoom) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE name=?, x_pos=?, z_pos=?, zoom=?",
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