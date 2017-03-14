<?php 

	function log_in($segments)
	{
		redirect('login/?goto='.$segments->uri_string());
	}

	if ( ! function_exists('clog'))
	{
		function clog($data)
		{
		    if(is_array($data) || is_object($data))
			{
				echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
			} 
			else 
			{
				echo("<script>console.log('PHP: ".$data."');</script>");
			}
		}
	}

?>