<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vicidial_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function lists($campaign = null)
	{
		if ($campaign)
		{
			return $this->db->get_where('vicidial_lists', ['campaign_id' => $campaign])->result_object();
		}
		else
		{
			return $this->db->get('vicidial_lists')->result_object();
		}
	}

	public function campaigns()
	{
		return $this->db->get('vicidial_campaigns')->result_object();
	}

}

/* End of file Vicidial_model.php */
/* Location: ./application/models/Vicidial_model.php */