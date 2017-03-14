<?php

class Api {

	protected $CI;
	protected $input_data;
	public $input_data_unparsed;
	protected $input_files;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
	}

	public function validate()
	{
		if ($this->CI->session->user)
		{	
			if (!empty($_FILES))
			{
				$this->input_files = $_FILES;
			}

			if ($this->method() === 'post')
			{
				$this->input_data_unparsed = trim(file_get_contents('php://input'));
				if (strlen(trim($this->input_data_unparsed)) == 0)
				{
					$this->input_data = $_POST;
				}
				else
				{
					parse_str($this->input_data_unparsed, $this->input_data);
				}
				return true;
			}
			else
			{
				$this->input_data_unparsed = trim(file_get_contents('php://input'));
				parse_str($this->input_data_unparsed, $this->input_data);

				if ((strlen(trim($this->input_data_unparsed)) > 0) || $this->method() == 'get' || $this->method() == 'delete')
				{	
					if ($this->method() == 'get')
					{
						$this->input_data = $_GET;
					}	
					return true;
				}
				else
				{
					$this->error(6);
					return false;
				}
			}
		}
		else
		{	
			$this->error(0);
		}		
	}

	public function method()
	{
		return strtolower($this->CI->input->method());
	}

	public function input($param = null)
	{	
		if ($param === null)
		{
			return $this->input_data;
		}
		else
		{
			if (array_key_exists($param, $this->input_data))
			{
				return $this->input_data[$param];
			}
			else
			{
				return null;
			}
		}
	}

	public function response($data)
	{
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function success($data = null)
	{
		if ($this->CI->session->user)
		{
			$this->response(['result' => 'success', 'data' => $data]);
		}
		else
		{
			$this->error(0);
		}
	}

	public function error($code)
	{
		if (is_int($code))
		{
			$this->response(['result' => 'error', 'data' => ['code' => $code, 'message' => $this->error_messages($code) .'.']]);
		}
		else
		{
			$this->response(['result' => 'error', 'data' => $code]);
		}
	}

	private function error_messages($code)
	{
		$messages = [
			0 	=> 'Not logged in',
			1 	=> 'Nothing found',
			2 	=> 'Incorrect use of the api',
			3	=> 'Not authorized',
			4	=> 'Method not supported',
			5	=> 'Action could not be performed',
			6	=> 'Request could not be validated'
		];
		return $messages[$code];
	}
}