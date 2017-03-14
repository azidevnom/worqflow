<?php

$date_start = ($this->input->get('start') !== null) ? $this->input->get('start') : date('Y-m-d');
$date_end = ($this->input->get('end') !== null) ? $this->input->get('end') : date('Y-m-d');

$def_campaign = $this->input->get('campaign');
$def_list = $this->input->get('list');

?>

<div class="container-fluid top-margin small">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<form> <!-- Form begin -->
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="start">Inicio</label>
									<input type="date" name="start" class="form-control" value="<?=$date_start?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="end">Fin</label>
									<input type="date" name="end" class="form-control" value="<?=$date_end?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="campaign">Campaña</label>
									<select name="campaign" id="" class="form-control chosen-select">
										<option value="--ALL--">Todas</option>
										<?php foreach ($campaigns as $campaign): ?>
											<option value="<?=$campaign->campaign_id?>" <?=($def_campaign == $campaign->campaign_id) ? "selected" : ""?>><?=$campaign->campaign_name?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="list">Lista</label>
									<select name="list" id="" class="form-control chosen-select">
										<option value="--ALL--">Todas</option>
										<?php foreach ($lists as $list): ?>
											<option value="<?=$list->list_id?>" <?=($def_list == $list->list_id) ? "selected" : ""?>><?=$list->list_name?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<label for="submit" class="invisible">Buscar</label>
								<button type="submit" class="btn btn-outline-primary form-control"><i class="fa fa-search" aria-hidden="true"></i> BUSCAR</button>
							</div>
						</div>
					</form> <!-- Form end -->
				</div>

				<!-- Results -->
				<?php if (isset($rows) && count($rows) > 0): ?>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="text-center">Agente</th>
								<th class="text-right">Total</th>
								<th class="text-right">Contactado</th>
								<th class="text-right">% Contactado</th>
								<th class="text-right">No Contactado</th>
								<th class="text-right">% No Contactado</th>
								<th class="text-right">Efectivo</th>
								<th class="text-right">% Efectivo</th>
								<th class="text-right">Útil Positivo</th>
								<th class="text-right">% Útil Positivo</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($rows as $row): ?>
								<tr>
									<td class="text-center"><?=$row->full_name?></td>
									<td class="text-right"><?=$row->total?></td>
									<td class="text-right"><?=$row->contactado?></td>
									<td class="text-right"><?=$row->p_contactado?></td>
									<td class="text-right"><?=$row->no_contactado?></td>
									<td class="text-right"><?=$row->p_no_contactado?></td>
									<td class="text-right"><?=$row->efectivo?></td>
									<td class="text-right"><?=$row->p_efectivo?></td>
									<td class="text-right"><?=$row->util?></td>
									<td class="text-right"><?=$row->p_util?></td>
								</tr>
							<?php endforeach ?>
							<!-- Totals row -->
							<tr class="active">
								<td class="text-center"><strong>TOTAL</strong></td>
								<td class="text-right"><strong><?=$totals->total?></strong></td>
								<td class="text-right"><strong><?=$totals->contactado?></strong></td>
								<td class="text-right"><strong><?=$totals->p_contactado?>%</strong></td>
								<td class="text-right"><strong><?=$totals->no_contactado?></strong></td>
								<td class="text-right"><strong><?=$totals->p_no_contactado?>%</strong></td>
								<td class="text-right"><strong><?=$totals->efectivo?></strong></td>
								<td class="text-right"><strong><?=$totals->p_efectivo?>%</strong></td>
								<td class="text-right"><strong><?=$totals->util?></strong></td>
								<td class="text-right"><strong><?=$totals->p_util?>%</strong></td>
							</tr>
						</tbody>
					</table>
					<div class="card-footer">
						<div class="text-right text-muted">
							La consulta tomó <?=$this->db->elapsed_time()?> segundos.
						</div>
					</div>
				<?php else: ?>
					<div class="card-block">
						<div class="text-left text-muted">
							Nada encontrado.
						</div>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>