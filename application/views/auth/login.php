<div class="container">
	<?php if (isset($error)): ?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<strong>Error!</strong> <br>
			<?php echo $error; ?>
		</div>
		<?php unset($error); ?>
	<?php endif ?>
	<div class="wrapper">
		<div class="logo-wrapper vcenter">					
				<img src="<?=asset('images/logo-1-w.png')?>" alt="">
			</div>
		<form class="form-signin" method="POST">
			<input type="text" class="form-control" name="login_user" placeholder="<?=lang('username')?>" required autofocus>
			<input type="password" class="form-control" name="login_passwd" placeholder="<?=lang('password')?>" required>      
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?=lang('log_in')?></button>   
		</form>
	</div>
</div>