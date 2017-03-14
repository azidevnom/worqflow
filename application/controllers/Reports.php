<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('vicidial/Vicidial_model', 'vicidial');
		$this->load->model('vicidial/Reports_model', 'vicidial_reports');
		$this->lang->load('vicidial');
	}

	public function index()
	{
		if ($this->session->user)
		{
			$this->load->view('header', ['title' => "Listado de reportes"]);
			$this->load->view('nav');
			$this->load->view('reports/list');
			$this->load->view('footer');
		}
		else
		{
			log_in($this->uri);
		}
	}

	public function realtime($report)
	{
		if ($this->session->user)
		{
			switch ($report)
			{
				case 'agentcalls': $this->realtime_agentcalls(); break;
				default: redirect('reports');	break;
			}
		}
		else
		{
			log_in($this->uri);
		}
	}

	public function agents($report)
	{
		if ($this->session->user)
		{
			switch ($report)
			{
				case 'metrics': $this->agent_metrics(); break;
				default: redirect('reports');	break;
			}
		}
		else
		{
			log_in($this->uri);
		}
	}

	// AGENT METRICS
	private function agent_metrics()
	{
		//$this->output->enable_profiler(TRUE);
		$data['campaigns'] = $this->vicidial->campaigns();
		$data['lists'] = $this->vicidial->lists();

		if (	
				($this->input->get('start')) !== null &&
				($this->input->get('end')) !== null &&
				($this->input->get('campaign')) !== null &&
				($this->input->get('list')) !== null
			)
		{
			$data['rows'] = $this->vicidial_reports->agent_metrics($this->input->get('start'), $this->input->get('end'), $this->input->get('campaign'), $this->input->get('list'));

			// Sums totals
			if (count($data['rows']) > 0)
			{
				$data['totals'] = new stdClass;
				$data['totals']->total = 0;
				$data['totals']->contactado = 0;
				$data['totals']->p_contactado = 0;
				$data['totals']->no_contactado = 0;
				$data['totals']->p_no_contactado = 0;
				$data['totals']->efectivo = 0;
				$data['totals']->p_efectivo = 0;
				$data['totals']->util = 0;
				$data['totals']->p_util = 0;

				foreach ($data['rows'] as $row)
				{
					$data['totals']->total = $data['totals']->total + $row->total;
					$data['totals']->contactado = $data['totals']->contactado + $row->contactado;
					$data['totals']->no_contactado = $data['totals']->no_contactado + $row->no_contactado;
					$data['totals']->efectivo = $data['totals']->efectivo + $row->efectivo;
					$data['totals']->util = $data['totals']->util + $row->util;
				}

				$data['totals']->p_contactado = round(($data['totals']->contactado / $data['totals']->total) * 100, 2);
				$data['totals']->p_no_contactado = round(($data['totals']->no_contactado / $data['totals']->total) * 100, 2);
				$data['totals']->p_efectivo = round(($data['totals']->efectivo / $data['totals']->total) * 100, 2);
				$data['totals']->p_util = round(($data['totals']->util / $data['totals']->total) * 100, 2);
			}
		}

		$crumbs = [
			['name' => lang('reports'), 'url' => site_url('reports')],
			['name' => lang('agents'), 'url' => site_url('reports/#agents')]
		];

		$this->load->view('header', ['title' => lang('reports_agents_metrics')]);
		$this->load->view('nav', ['crumbs' => $crumbs]);
		$this->load->view('reports/agents/metrics', $data);
		$this->load->view('footer');
	}

	// REALTIME AGENTS/CALLS
	private function realtime_agentcalls()
	{

		$crumbs = [
			['name' => lang('reports'), 'url' => site_url('reports')],
			['name' => lang('realtime'), 'url' => site_url('reports/#realtime')]
		];

		$this->load->view('header', ['title' => lang('reports_realtime_agentcalls')]);
		$this->load->view('nav', ['crumbs' => $crumbs]);
		$this->load->view('realtime/agentcalls');
		$this->load->view('footer');
	}

}

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */