<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Vicidial_model', 'vicidial');
	}

	public function agent_metrics($start, $end, $campaign, $list)
	{
		$campaign = ($campaign == "--ALL--") ? "" : " AND vl.campaign_id = '{$campaign}'";
		$list = ($list == "--ALL--") ? "" : " AND vl.list_id = '{$list}'";

		$query = "SELECT t3.full_name, COUNT(t3.lead_id) AS 'total', SUM(CASE t3.category WHEN 'CONTACTADO' THEN 1 WHEN 'EFECTIVO' THEN 1 ELSE 0 END) as 'contactado', concat(round((SUM(CASE WHEN t3.category = 'CONTACTADO' THEN 1 ELSE 0 END) / count(t3.lead_id)) * 100,2), '%') AS 'p_contactado', SUM(CASE WHEN t3.category = 'NO_CONTACTADO' THEN 1 ELSE 0 END) as 'no_contactado', concat(round((SUM(CASE WHEN t3.category = 'NO_CONTACTADO' THEN 1 ELSE 0 END) / count(t3.lead_id)) * 100,2), '%') AS 'p_no_contactado', SUM(CASE WHEN t3.category = 'EFECTIVO' THEN 1 ELSE 0 END) as 'efectivo', concat(round((SUM(CASE WHEN t3.category = 'EFECTIVO' THEN 1 ELSE 0 END) / count(t3.lead_id)) * 100,2), '%') AS 'p_efectivo', SUM(CASE WHEN t3.status = 'UP' THEN 1 ELSE 0 END) AS 'util', concat(round((SUM(CASE WHEN t3.status = 'UP' THEN 1 ELSE 0 END) / count(t3.lead_id)) * 100,2),'%') AS 'p_util' FROM (SELECT t2.*, vu.full_name, vcs.category FROM (SELECT *, MAX(rank) FROM (SELECT lead_id, list_id, user, vl.campaign_id as 'campaign_id', call_date, vl.status as 'status', rank FROM vicidial_log vl LEFT JOIN simtastic_status_rank sr ON vl.campaign_id = sr.campaign_id AND vl.status = sr.status WHERE call_date BETWEEN '{$start} 00:00:00' AND '{$end} 23:59:59' {$campaign} {$list}) AS t1 WHERE rank IS NOT NULL GROUP BY lead_id, rank, call_date ORDER BY lead_id, rank DESC, call_date ASC) AS t2 LEFT JOIN vicidial_users vu ON t2.user = vu.user LEFT JOIN vicidial_campaign_statuses vcs ON t2.status = vcs.status AND t2.campaign_id = vcs.campaign_id GROUP BY t2.lead_id) AS t3 GROUP BY t3.user";

		return $this->db->query($query)->result_object();
	}
}

/* End of file VicidialReports_model.php */
/* Location: ./application/models/VicidialReports_model.php */


