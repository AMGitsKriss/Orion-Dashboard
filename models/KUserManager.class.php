<?php

	//TODO - Should probably extend this...
	require("models/PasswordHash.class.php");

	class KUserManager{
		
		private $hasher, $database, $username, $password;

		function __construct($database){
			$this->hasher = new PasswordHash(8, false);
			$this->database = $database;
		}

		function loginCheck(){
			if(isset($password) && isset($username)){
				$query = $this->database->query("selectUser", $username);
				if($query->rowCount() == 1 && $row = $query->fetch(PDO::FETCH_ASSOC)){
					$storedHash = $row["password"]; 
					if($this->hasher->CheckPassword($password, $storedHash)){
						return $row["username"];
					}
				}
			}
			return false;
		}

		function getUser($username){
			$query = $this->database->query("selectUser", $username);
			if($query->rowCount() == 1 && $row = $query->fetch(PDO::FETCH_ASSOC)){
				$userdata = new stdClass();
				$userdata->username = $row["username"];
				$userdata->email = $row["email"];
				$userdata->mc_username = $row["mc_username"];
				$userdata->mc_avatar = $row["mc_avatar"];
				return $userdata;
			}
			else return false;
		}
	}
?>