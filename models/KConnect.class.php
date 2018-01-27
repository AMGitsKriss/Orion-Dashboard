<?php

	// TODO - How does the namespace thing work?
	//namespace KConnect;

	class KConnect {

		//Defining the Database Connection and Tables list.
		private $conn;

		private $sql = [
			"selectUser" => "SELECT * FROM users WHERE username=?",
			"insertUser" => "INSERT INTO users (username, email, password) VALUES (?, ?, ?)",
			"selectURLHash" => "SELECT url, hash FROM LinkAggregator WHERE hash = ?",
			"selectList" => "SELECT id, added, name, url, hash FROM LinkAggregator WHERE owner=? ORDER BY id DESC",
			"selectMapShortcut" => "SELECT * FROM map_shortcuts WHERE name=?",
			"updateMapShortcut" => "INSERT INTO map_shortcuts (name, x_pos, z_pos, zoom) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE name=?, x_pos=?, z_pos=?, zoom=?",
			"deletePost" => "DELETE FROM LinkAggregator where id=? AND owner=?",
			"insertPost" => "INSERT INTO LinkAggregator (name, url, IP, owner) VALUES (?, ?, ?, ?)",
			"shortenPost" => "UPDATE LinkAggregator SET hash=concat(
				substring('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(id)*4294967296))*62+1, 1),
				substring('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*62+1, 1),
				substring('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed:=round(rand(@seed)*4294967296))*62+1, 1),
				substring('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand(@seed)*62+1, 1)) WHERE id = LAST_INSERT_ID()",
			"purgeOldCookies" => "DELETE FROM user_sessions WHERE updated < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL ? DAY))",
			"insertCookie" => "INSERT INTO user_sessions (cookie, username) VALUES (?, ?)",
			"selectCookie" => "SELECT * FROM user_sessions WHERE cookie = ?",
			"updateCookie" => "UPDATE user_sessions WHERE cookie = ? SET updated=CURRENT_TIMESTAMP",
			"selectRossQuotes" => "SELECT * FROM posts WHERE category = 'Ross Quotes' ORDER BY RAND() LIMIT 1",
			"updateUserPass" => "UPDATE users WHERE username = ? SET password = ?",
			"getMenu" => "CALL getMenu(?)"
		];

		//Initialise the connection.
		function __construct($servername, $dbname, $username, $password, $sql = []){
			// Add to the array of SQL calls
			$this->sql = array_merge($this->sql, $sql);
			try{
				$this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			}
			catch (Exception $e){
				print "<p>Database Connection Derp: " . $e->getMessage() . "</p>";
				die();
			}
		}

		/*
		 *	TODO - Write about what the hell this function returns!
		 */
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