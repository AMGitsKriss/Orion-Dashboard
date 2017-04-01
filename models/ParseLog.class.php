<?php

	class ParseLog{

		$extension = "gz";

		function __construct($dir, $database){
			$this->dir = $dir;
			$this -> $database;
		}

		getDirFiles(){
			// Get a list of $extension files from $dir
		}

		getDBFiles(){
			// Get a lost of the files already parsed from the database
			// Database query (unique) then loop over it and make a list of strings.
		}
	}

?>