<?php 

	if ( ! function_exists('asset'))
	{
		function asset($uri = '', $protocol = NULL)
		{
			// Assets version
			// $assets_version = ASSETS_VERSION;
			
			// return get_instance()->config->site_url('assets/'. $assets_version . '/' . $uri, $protocol);
			return get_instance()->config->site_url('assets/' . $uri, $protocol);
		}
	}

	if ( ! function_exists('polymer'))
	{
		function polymer($elements = NULL, $protocol = NULL)
		{
			// Polymer folder
			$polymer_folder = 'polymer';

			$output = '';
			
			if ($elements != NULL && count($elements > 0))
			{
				$output = '<script src="'. get_instance()->config->site_url($polymer_folder . '/bower_components/webcomponentsjs/webcomponents-lite.min.js', $protocol) . '"></script>' ."\n";

				foreach ($elements as $e) 
				{
					$output = $output . '<link rel="import" href="' . get_instance()->config->site_url($polymer_folder . '/bower_components/' . $e . '/' . $e . '.html', $protocol) . '">' . "\n";
				}
			}
			return $output;
		}
	}

?>