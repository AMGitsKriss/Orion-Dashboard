<?php
	class KConnect {

		//Defining the Database Connection and Tables list.
		private $conn;

		private $sql = [
			"selectPost" => "SELECT * from LinkAggregator WHERE id=?",
			"updatePost" => "",
			"deletePost" => "DELETE FROM LinkAggregator where id=? AND owner=?",
			"insertPost" => "INSERT INTO LinkAggregator (name, url, IP, owner) VALUES (?, ?, ?, ?)",
			"selectList" => "SELECT id, added, name, url FROM LinkAggregator WHERE owner=? ORDER BY id DESC",
			"selectUser" => "SELECT * FROM users WHERE username=?",
			"insertUser" => ""
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
				$statement->execute($data);
			}
			catch(Exception $e){
				//spit back an error
				$msg = "<p>You tried to run this sql: $entrySQL<p>\n<p>Exception: $e</p>";
				trigger_error($msg);
			}
			return $statement;
		}

		//Returns all entries of a named table. 
		//Should not be called in regular use.
		function getAll($table){
			$sql = "SELECT * FROM $table";

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
			return $statement;
		}
	}
?>