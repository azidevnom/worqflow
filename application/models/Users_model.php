<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function login ($user, $passwd)
	{
		$r = $this->db->get_where('vicidial_users', ['user' => $user, 'pass' => $passwd, 'user_level >=' => 8])->result_array();
		if (count($r) === 1)
		{
			return $r[0];
		}
		else
		{
			return FALSE;
		}
	}
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */