# Orion-Dashboard
Gaming community dashboard. 

#### Notes
* The following is the order of priority that URL's are resolved by:
  1. A folder directory.
  2. A page's GET statement.
  3. URL Shortener (URL Query String)
* URL Poster/Shortener: http://localhost/? ...

#### Issue Tracking & Planning
[Jira|http://jira.qvvz.uk]

#### Config.php
```
<?php
	ini_set("display_startup_errors", 1); // Show Errors
	$host = "http://localhost/"; // Address for URLs
	$site_title = "Orion"; 
	$db_name = "orion_dashboard";
	$db_user = "root";
	$db_pass = "";
	$ts_username = "serveradmin";
	$ts_password = "password";
?>
```
