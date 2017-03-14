<nav class="navbar sticky-top navbar-toggleable-md navbar-light bg-faded">

	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<a class="navbar-brand" href="#"><?=APP_TITLE?></a>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="divider-vertical"></li>
			<li class="nav-item">
				<nav class="breadcrumb">
					<?php if (isset($crumbs)): ?>
						<?php foreach ($crumbs as $crumb): ?>
							<a class="breadcrumb-item" href="<?=$crumb['url']?>"><?=$crumb['name']?></a>
						<?php endforeach ?>
					<?php endif ?>
					<span class="breadcrumb-item active"><?=(isset($title)) ? $title : ""?></span>
				</nav>
			</li>
		</ul>

		<ul class="navbar-nav">
			<li class="divider-vertical"></li>
			<li class="nav-item">
				<a class="nav-link" href="<?=site_url('reports')?>"><i class="fa fa-bar-chart" aria-hidden="true"></i> <?=lang('reports')?></a>
			</li>
			<li class="divider-vertical"></li>
			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?=$this->session->user->name?> <span class="caret"></span></a>
				<div class="dropdown-menu dropdown-menu-right animated fadeInDown" style="animation-duration: .2s">
					<div class="dropdown-item-panel">
					</div>
					<a class="dropdown-item" href="<?=site_url('logout')?>"><i class="fa fa-power-off" aria-hidden="true"></i> <?=lang('log_out')?></a>
				</div>
			</li>
		</ul>
	</div>
</nav>

<!-- Disable panel hiding on clic -->
<script>
	$('.dropdown-item-panel').on('click', function(e) {
		e.stopPropagation();
	});
</script>
