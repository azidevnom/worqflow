<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Realtime_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('vicidial');
		
	}

	public function realtime()
	{
		$query = 
		$this->db->query(	"SELECT vla.live_agent_id, 
												vla.user, 
												vla.server_ip, 
												vla.conf_exten, 
												vla.extension, 
												IF(vla.status IN ('PAUSED','READY') AND vla.lead_id >0 ,'DISPO', IF( vla.status = 'INCALL' AND vac.lead_id IS NOT NULL AND vla.comments NOT IN ('EMAIL', 'MESSAGE'), 'DEAD', vla.status)) as status, 
												vla.lead_id, 
												vla.campaign_id, 
												vla.uniqueid, 
												vla.callerid, 
												vla.channel, 
												vla.random_id, 
												vla.last_call_time, 
												vla.last_update_time, 
												vla.last_call_finish, 
												vla.closer_campaigns, 
												vla.call_server_ip, 
												vla.user_level, 
												vla.comments, 
												vla.campaign_weight, 
												vla.calls_today, 
												vla.external_hangup, 
												vla.external_status, 
												vla.external_pause, 
												vla.external_dial, 
												vla.external_ingroups, 
												vla.external_blended, 
												vla.external_igb_set_user, 
												vla.external_update_fields, 
												vla.external_update_fields_data, 
												vla.external_timer_action, 
												vla.external_timer_action_message, 
												vla.external_timer_action_seconds, 
												vla.agent_log_id, 
												vla.last_state_change, 
												vla.agent_territories, 
												vla.outbound_autodial, 
												vla.manager_ingroup_set, 
												vla.ra_user, 
												vla.ra_extension, 
												vla.external_dtmf, 
												vla.external_transferconf, 
												vla.external_park, 
												vla.external_timer_action_destination, 
												vla.on_hook_agent, 
												vla.on_hook_ring_time, 
												vla.ring_callerid, 
												vla.last_inbound_call_time, 
												vla.last_inbound_call_finish, 
												vla.campaign_grade, 
												vla.external_recording, 
												vu.full_name AS 'full_name', 
												CONCAT(vac.phone_code, vac.phone_number) As 'phone', 
												IF( vla.comments = 'INBOUND' , vac.campaign_id, NULL ) AS 'inbound', 
												NULL AS 'substatus', 
												TIMEDIFF( NOW(), vla.last_state_change ) AS 'elapsed_time' 
												FROM vicidial_live_agents vla 
												INNER JOIN vicidial_users vu ON vla.user = vu.user 
												LEFT JOIN vicidial_auto_calls vac ON vla.lead_id = vac.lead_id AND vac.status <> 'IVR';"
		);

		$agents_data = $query->result_array();

		// Filling table headers
		$headers = [];
		$headers[] = $this->lang->line('realtime_live_agent_id'); // Live Agent ID
		$headers[] = $this->lang->line('realtime_user'); // User
		$headers[] = $this->lang->line('realtime_server_ip'); // Server IP
		$headers[] = $this->lang->line('realtime_conf_exten'); // Conf Exten
		$headers[] = $this->lang->line('realtime_extension'); // Extension
		$headers[] = $this->lang->line('realtime_status'); // Status
		$headers[] = $this->lang->line('realtime_lead_id'); // Lead ID
		$headers[] = $this->lang->line('realtime_campaign_id'); // Campaign ID
		$headers[] = $this->lang->line('realtime_uniqueid'); // Unique ID
		$headers[] = $this->lang->line('realtime_callerid'); // Caller ID
		$headers[] = $this->lang->line('realtime_channel'); // Channel
		$headers[] = $this->lang->line('realtime_random_id'); // Random ID
		$headers[] = $this->lang->line('realtime_last_call_time'); // Last Call Time
		$headers[] = $this->lang->line('realtime_last_update_time'); // Last Update Time
		$headers[] = $this->lang->line('realtime_last_call_finish'); // Last Call Finish
		$headers[] = $this->lang->line('realtime_closer_campaigns'); // Closer Campaigns
		$headers[] = $this->lang->line('realtime_call_server_ip'); // Call Server IP
		$headers[] = $this->lang->line('realtime_user_level'); // User Level
		$headers[] = $this->lang->line('realtime_comments'); // Comments
		$headers[] = $this->lang->line('realtime_campaign_weight'); // Campaign Weight
		$headers[] = $this->lang->line('realtime_calls_today'); // Calls Today
		$headers[] = $this->lang->line('realtime_external_hangup'); // External Hangup
		$headers[] = $this->lang->line('realtime_external_status'); // External Status
		$headers[] = $this->lang->line('realtime_external_pause'); // External Pause
		$headers[] = $this->lang->line('realtime_external_dial'); // External Dial
		$headers[] = $this->lang->line('realtime_external_ingroups'); // External Ingroups
		$headers[] = $this->lang->line('realtime_external_blended'); // External Blended
		$headers[] = $this->lang->line('realtime_external_igb_set_user'); // External IGB Set User
		$headers[] = $this->lang->line('realtime_external_update_fields'); // External Update Fields
		$headers[] = $this->lang->line('realtime_external_update_fields_data'); // External Update Fields Data
		$headers[] = $this->lang->line('realtime_external_timer_action'); // External Timer Action
		$headers[] = $this->lang->line('realtime_external_timer_action_message'); // External Timer Action Message
		$headers[] = $this->lang->line('realtime_external_timer_action_seconds'); // External Time Action Seconds
		$headers[] = $this->lang->line('realtime_agent_log_id'); // Agent Log ID
		$headers[] = $this->lang->line('realtime_last_state_change'); // Last State Change
		$headers[] = $this->lang->line('realtime_agent_territories'); // Agent Territories
		$headers[] = $this->lang->line('realtime_outbound_autodial'); // Outbound Autodial
		$headers[] = $this->lang->line('realtime_manager_ingroup_set'); // Manager Ingroup Set
		$headers[] = $this->lang->line('realtime_ra_user'); // RA User
		$headers[] = $this->lang->line('realtime_ra_extension'); // RA Extension
		$headers[] = $this->lang->line('realtime_external_dtmf'); // External DTMF
		$headers[] = $this->lang->line('realtime_external_transferconf'); // External Transferconf
		$headers[] = $this->lang->line('realtime_external_park'); // External Park
		$headers[] = $this->lang->line('realtime_external_timer_action_destination'); // External Timer Action Destination
		$headers[] = $this->lang->line('realtime_on_hook_agent'); // On Hook Agent
		$headers[] = $this->lang->line('realtime_on_hook_ring_time'); // On Hook Ring Time
		$headers[] = $this->lang->line('realtime_ring_callerid'); // Ring Caller ID
		$headers[] = $this->lang->line('realtime_last_inbound_call_time'); // Last Inbound Call Time
		$headers[] = $this->lang->line('realtime_last_inbound_call_finish'); // Last Inbound Call Finish
		$headers[] = $this->lang->line('realtime_campaign_grade'); // Campaign Grade
		$headers[] = $this->lang->line('realtime_external_recording'); // External Recording
		$headers[] = $this->lang->line('realtime_full_name'); // Full Name
		$headers[] = $this->lang->line('realtime_phone'); // Phone
		$headers[] = $this->lang->line('realtime_inbound'); // Inbound
		$headers[] = $this->lang->line('realtime_substatus'); // SubStatus
		$headers[] = $this->lang->line('realtime_elapsed_time'); // Elapsed Time

		$indicators = 	[
											'connected' => ['value' => 0, 'label' => $this->lang->line('indicator_connected'), 'status' => 'CONNECTED'],
											'talking' => ['value' => 0, 'label' => $this->lang->line('indicator_talking'), 'status' => 'INCALL'],
											'inbound' => ['value' => 0, 'label' => $this->lang->line('indicator_inbound'), 'status' => 'INBOUND'],
											'auto' => ['value' => 0, 'label' => 'Outbound', 'status' => 'AUTO'],
											'manual' => ['value' => 0, 'label' => $this->lang->line('indicator_manual'), 'status' => 'MANUAL'],
											'paused' => ['value' => 0, 'label' => $this->lang->line('indicator_paused'), 'status' => 'PAUSED'],
											'ready' => ['value' => 0, 'label' => $this->lang->line('indicator_ready'), 'status' => 'READY'],
											'dispo' => ['value' => 0, 'label' => $this->lang->line('indicator_dispo'), 'status' => 'DISPO'],
											'dead' => ['value' => 0, 'label' => $this->lang->line('indicator_dead'), 'status' => 'DEAD']
										];

		// Calculate icons data
		foreach ($agents_data as $agent)
		{
			$indicators['connected']['value']++;
			if ($agent['status'] == 'INCALL') { $indicators['talking']['value']++; };
			if ($agent['status'] == 'INCALL' AND $agent['comments'] == 'INBOUND') { $indicators['inbound']['value']++; };
			if ($agent['status'] == 'INCALL' AND $agent['comments'] == 'AUTO') { $indicators['auto']['value']++; };
			if ($agent['status'] == 'INCALL' AND $agent['comments'] == 'MANUAL') { $indicators['manual']['value']++; };
			if ($agent['status'] == 'PAUSED') { $indicators['paused']['value']++; };
			if ($agent['status'] == 'READY' OR $agent['status'] == 'CLOSER') { $indicators['ready']['value']++; };
			if ($agent['status'] == 'DISPO') { $indicators['dispo']['value']++; };
			if ($agent['status'] == 'DEAD') { $indicators['dead']['value']++; };
		};

		$arr_indicators = [];
		foreach ($indicators as $key => $value) {
			$arr_indicators[] = $value;
		}

		return ['indicators' => $arr_indicators, 'headers' => $headers ,'agents' => $agents_data];
	}

}

/* End of file  */
/* Location: ./application/models/vicidial */