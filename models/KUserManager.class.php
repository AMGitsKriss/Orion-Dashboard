<?php

	//TODO - Should probably extend this...
	require("models/PasswordHash.class.php");

	class KUserManager{
		
		private $hasher, $database, $username, $password;

		function __construct($database, $username, $password){
			$this->hasher = new PasswordHash(8, false);
			$this->database = $database;
			$this->username = $username;
			$this->password = $password;
		}

		function loginCheck(){
			if(isset($this->password) && isset($this->username)){
				$query = $this->database->query("selectUser", $this->username);
				if($query->rowCount() == 1 && $row = $query->fetch(PDO::FETCH_ASSOC)){
					$storedHash = $row["password"]; 
					if($this->hasher->CheckPassword($this->password, $storedHash)){
						return $row["username"];
					}
				}
			}
			return false;
		}

		function getUSer($username){
			$query = $this->database->query("selectUser", $this->username);
			if($query->rowCount() == 1 && $row = $query->fetch(PDO::FETCH_ASSOC)){
				$userdata->username = $row["username"];
				$userdata->email = $row["email"];
				$userdata->mc_username = $row["mc_username"];
				$userdata->mc_avatar = $row["mc_avatar"];
			}
		}
	}
?>