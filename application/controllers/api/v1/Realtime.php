<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Realtime extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Api');
		$this->load->model('vicidial/Realtime_model', 'realtime');
	}

	public function index()
	{
		$this->api->success($this->realtime->realtime());
	}

}

/* End of file Realtime.php */
/* Location: ./application/controllers/api/v1/Realtime.php */