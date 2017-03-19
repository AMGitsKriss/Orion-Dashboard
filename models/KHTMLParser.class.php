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
	}
?>