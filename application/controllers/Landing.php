<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('vicidial');
	}

	public function index()
	{
		if ($this->session->user)
		{
			$this->load->view('header');
			$this->load->view('nav');
		}
		else
		{
			$this->load->view('header', ['styles' => ['login']]);
			$this->load->view('landing');
		}
		$this->load->view('footer');
	}
	
	public function login()
	{
		// check if the user is already logged in
		if ($this->session->user)
		{
			redirect("/",'refresh');
			clog("is user");
		}
		else
		{
			$ref = '/';
			// check if login params were posted
			if ($this->input->get('goto'))
			{
				// retrieving referer to redirect after login
				$ref = $this->input->get('goto');
				if ((strpos($ref, site_url()) !== false) && (strpos($ref, "/login") == false))
				{
					$ref = str_replace(site_url(), "", $ref);
				}
			}

			$this->load->model('Users_model', 'users');
			// verify login data
			if ($this->input->post('login_user'))
			{
				$login = $this->users->login($this->input->post('login_user'), $this->input->post('login_passwd'));
				if ($login)
				{
					// User properties
					$user = new stdClass;
					$user->user = $login['user'];
					$user->name = $login['full_name'];
					$user->level = $login['user_level'];
					$user->group = $login['user_group'];

					$this->session->set_userdata(['user' => $user]);
					redirect($ref,'refresh');
				}
				else
				{
					$this->load->view('header', ['title' => "Ingreso de usuario", 'styles' => ['login']]);
					$this->load->view('auth/login', ['error' => "Usuario o contraseña inválidos."]);
					$this->load->view('footer');
				}
			}
			else
			{
				$this->load->view('header', ['title' => "Ingreso de usuario", 'styles' => ['login']]);
				$this->load->view('auth/login');
				$this->load->view('footer');
			}
		}
	}

	public function logout()
	{
		if ($this->session->user)
		{
			$this->session->unset_userdata('user');
		}
		redirect('/','refresh');
	}
}
