<div class="container top-margin">
	<div class="row" id="realtime">
		<div class="col-12">
			<h2><i class="fa fa-line-chart" aria-hidden="true"></i> <?=lang('realtime')?></h2>
			<hr>
		</div>
		<div class="col-md-6">
			<div class="list-group">
				<a href="<?=site_url('reports/realtime/agentcalls')?>" class="d-block list-group-item">
					<span class="align-middle">
						<h4><?=lang('reports_realtime_agentcalls')?></h4>
						<p><?=lang('reports_realtime_agentcalls_desc')?></p>
					</span>
				</a>
			</div>
		</div>
	</div>
	<hr>
	<div class="row top-margin" id="agents">
		<div class="col-12">
			<h2><i class="fa fa-users" aria-hidden="true"></i> <?=lang('agents')?></h2>
			<hr>
		</div>
		<div class="col-md-6">
			<div class="list-group">
				<a href="<?=site_url('reports/agents/metrics')?>" class="d-block list-group-item">
					<span class="align-middle">
						<h4><?=lang('reports_agents_metrics')?></h4>
						<p><?=lang('reports_agents_metrics_desc')?></p>
					</span>
				</a>
			</div>
		</div>
	</div>
</div>