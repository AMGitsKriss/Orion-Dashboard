<?php

	//TODO - Should probably extend this...
	require("models/PasswordHash.class.php");

	class KUserManager{
		
		private $hasher, $database, $username, $password;

		function __construct($database){
			$this->hasher = new PasswordHash(8, false);
			$this->database = $database;
		}

		function loginCheck($username, $password){
			if(isset($password) && isset($username)){
				$query = $this->database->query("selectUser", $username);
				if($query->rowCount() == 1 && $row = $query->fetch(PDO::FETCH_ASSOC)){
					$storedHash = $row["password"]; 
					# If the password is right, and the user is approved
					if($this->hasher->CheckPassword($password, $storedHash)){
						# If approved, return the username
						if($row["account_approved"] == true){
							return $row["username"];
						}
						# Otherwise a loginerror
						else {
							return false;
						}
					}
				}
			}
			return null;
		}

		function getUser($username){
			$query = $this->database->query("selectUser", $username);
			if($query->rowCount() == 1 && $row = $query->fetch(PDO::FETCH_ASSOC)){
				$userdata = new stdClass();
				#RETURNS THE FOLLOWING 
				$userdata->username = $row["username"];
				$userdata->email = $row["email"];
				$userdata->mc_username = $row["mc_username"];
				$userdata->mc_avatar = $row["mc_avatar"];
				return $userdata;
			}
			else return false;
		}

		function checkPasswordLength($password){
			if(strlen($password) >= 6){
				return true;
			}
			return false;
		}

		function makeUser($username, $email, $password){
			# If the password hashes to something other than a hash...
			if(($password = $this->hasher->HashPassword($password)) !== "*" && $this->checkPasswordLength($password)){
				if($query = $this->database->query("insertUser", $username, $email, $password)){
					# The only error here should be a duplicate key error.
					if(gettype($query) == "string"){
						return "That username already exists.";
					}
					#If it went without a hitch...
					return true;
				}

			}
			# If the password is too short
			elseif(!checkPasswordLength($password)){
				# TODO - Password too short
				return "Password too short.";
			}
			# Else something went wrong with the hash
			else{
				# TODO - Some weird error. 
				return "Something weird happened.";
			}
		}

		function updatePassword($username){
			# TODO
		}

		function checkCookie($cookie){
			$query = $database->query("selectCookie", $cookie)
			//If the cookie is valid, update the timestamp and return true.
			if($query->rowCount() == 1){
				$this->updateCookie($cookie);
				return true;
			}
			// Otherwise, the user's session has timed out. Change cookie to have expired already.
			setcookie("orion_user_session", $cookie, time() - 86400, "/");
			return false;
		}

		/*
		 *	Update the expiry date on the database cookie.
		 */
		function updateCookie($cookie){
			if($database->query("updateCookie", $cookie)){
				return true;
			}
			return false;
		}

		//Calls updateCookie() with the pre-defined timelimit.
		function purgeCookies(){
			$days = 30;
			$this->purgeCookies($days);
		}

		// A query to check the table for any entries more than 30 days old. OR user specified time.
		function purgeCookies($days){
			$database->query("purgeOldCookies", $days);
		}

		// Takes the username and adds a cookie in the database. If successful, adds in browser.
		function setCookie($username){
			$cookie = uniqid($username."_");
			if($database->query("insertCookie", $cookie, $username)){
				setcookie("orion_user_session", $cookie, time() + (86400 * 30), "/");
			}
		}
	}
?>