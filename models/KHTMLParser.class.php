<?php
	class KHTMLParser{

		//Parsing a webpage
		function file_get_contents_curl($url){
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

			$data = curl_exec($ch);
			curl_close($ch);

			return $data;
		}

		function httpPrefix($url){
			if(!(substr( $url, 0, 7 ) === "http://" || substr( $url, 0, 8 ) === "https://")){
				$url = "http://" . $url;
			}

			return $url;
		}

		/*
		 *	Accepts the query string, since we should know it's a URL.
		 */
		function handle($url, $database){
			$url = $this->httpPrefix($url);
			$urlContents = $this->file_get_contents_curl($url);

			$dom = new DOMDocument();
			@$dom->loadHTML($urlContents);

			$title = $dom->getElementsByTagName('title');	
			$name = $title->item(0)->nodeValue; // "Example Web Page"

			//Is this an image?
			if((strpos($url, '.jpg') || strpos($url, '.jpeg')|| strpos($url, '.png') || strpos($url, '.gif'))){
				$name = "<a href='".$url."'><img class=thumb src='".$url."'></a>";
			}
			//YOUTUBE
			if(strpos($url, 'youtube.com') !== false){
				$name = '<iframe width="330" height="186" src="' . $url . '" frameborder="0" allowfullscreen>This might be broken...</iframe>';
			}

			//Saving the IP of whoever added the link
			$srcIp = $_SERVER['REMOTE_ADDR'];
			try{
				require("models/KUserManager.class.php");
				# Get user from the database
				$userCheck = new KUserManager($database);
				// Insert the link & set the owner to this user,
				$database->query("insertPost", $name, $url, $srcIp, $userCheck->getUser($_COOKIE['orion_user_session'])->username);
				$database->query("shortenPost");
				return true;
			}
			catch(Exception $e){
				//spit back an error
				$output .= $msg = "<p>Server failed to add your post.</p>"; //TODO - Can I do this? <---
				trigger_error($msg);
				return false;
			}
		}
	}
?>