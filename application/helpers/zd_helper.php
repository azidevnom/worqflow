<?php 

	if ( ! function_exists('zdQuery'))
	{
		function zdQuery($url, $json, $action)
		{
			$ZDAPIKEY = "";
			$ZDUSER = "";
			$ZDURL = "";

		    $ch = curl_init();
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 10 );
			curl_setopt($ch, CURLOPT_URL, $ZDURL.$url);
			curl_setopt($ch, CURLOPT_USERPWD, $ZDUSER."/token:".$ZDAPIKEY);
			switch($action){
				case "POST":
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
					break;
				case "GET":
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
					break;
				case "PUT":
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
					curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
					break;
				case "DELETE":
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
					break;
				default:
					break;
			}

			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
			curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$output = curl_exec($ch);
			//$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			//$resp = (Object) ['code' => $httpcode, 'response' => json_decode($output)];
			curl_close($ch);
			return json_decode($output);
		}
	}

?>