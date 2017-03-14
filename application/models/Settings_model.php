<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function save($data)
	{
		$d = (Array) json_decode($data);

		$filter = ['user' => $this->session->user->user, 'section' => $d['section'], 'type' => $d['type'], 'name' => $d['name']];
		$q = $this->db->get_where('worqflow_settings', $filter)->result_array();

		if (count($q) > 0) {
			return $this->db->update('worqflow_settings', ['data' => json_encode($d['data'])], $filter);
		}
		else
		{
			return $this->db->insert('worqflow_settings', ['user' => $this->session->user->user, 'section' => $d['section'], 'type' => $d['type'], 'name' => $d['name'], 'data' => json_encode($d['data'])]);
		}
	}

	public function retrieve($data)
	{
		if (isset($data['section']) && isset($data['type']) && isset($data['name']))
		{
			$data['user'] = $this->session->user->user; 
			return $this->db->get_where('worqflow_settings', $data)->result_object();
		}
		else
		{
			return [];
		}
	}

}

/* End of file Settings_model.php */
/* Location: ./application/models/Settings_model.php */