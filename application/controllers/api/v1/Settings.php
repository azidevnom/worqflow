<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Api');
		$this->load->model('Settings_model', 'settings');
	}

	public function index()
	{
		$this->api->validate();
		$data = $this->api->input();

		switch ($this->api->method()) {

			case 'get':
				$r = $this->settings->retrieve($data);
				if (count($r) > 0) { $this->api->success($r[0]->data); }
				else { $this->api->error('Setting not found'); } 
				break;

			case 'post': 
				$this->api->success($this->settings->save($this->api->input_data_unparsed));
				break;

			default: break;
		}
	}

}

/* End of file Settings.php */
/* Location: ./application/controllers/api/v1/Settings.php */