<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resources extends CI_Controller {

	public function res($path)
	{
 		$uris = [];
		if ($this->uri->total_segments() > 1)
		{
			for ($i=2; $i < ($this->uri->total_segments() + 1); $i++) { 
				$uris[] = $this->uri->segment($i);
			}

			$fp = realpath('../application/'.$path.'/'.implode("/", $uris));
			if (file_exists($fp))
			{
				$ext = pathinfo($fp, PATHINFO_EXTENSION);
				$finfo = finfo_open(FILEINFO_MIME_TYPE); 
				$mime = finfo_file($finfo,$fp);
				
				if ($ext == 'css')
				{
					$this->output->set_content_type('css','utf-8');
				}
				else
				{
					$this->output->set_content_type($mime);
				}

				$this->output->set_output(file_get_contents($fp));
			}
			else
			{
				$this->output->set_status_header('404');
			}
		}
	}

	public function resource() {
 		session(FALSE);
		$this->res('resources');
	}

	public function asset() {
		$this->res('assets');
	}
}

/* End of file Resources.php */
/* Location: ./application/controllers/Resources.php */