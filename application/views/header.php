<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">-->
	<!--<link rel="icon" type="image/png" href="../assets/img/favicon.png">-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?=APP_TITLE.(isset($title) ? " | ".$title : "")?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>

	<!--     Fonts, icons and default CSS    -->
	<!-- BOOSTRAP -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

	<!-- JQUERY -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- BULMA -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.3.2/css/bulma.min.css"> -->

	<!-- AXIOS -->
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

	<!-- TETHER -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

	<!-- BOOTSTRAP JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	<!-- LATO FONT -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400|Roboto:300,400">

	<!-- NOTIFY -->
	<!-- <script src="/assets/js/notify.js"></script> -->

	<!-- WORQFLOW -->
	<script src="/assets/js/worqflow.js"></script>

	<!-- VUE -->
	<script src="https://unpkg.com/vue/dist/vue.js"></script>
	
	<!-- ANIMATE CSS -->
	<link rel="stylesheet" href="<?=asset('css/animate.css')?>">

	<!-- FONT AWESOME -->
	<script src="https://use.fontawesome.com/fe3501a018.js"></script>

	<!-- MATERIAL ICONS -->
	<link rel="stylesheet" href="<?=asset('css/material-icons.css')?>">

	<!-- STYLES -->
	<link rel="stylesheet" href="<?=asset('css/style.css')?>">

	<!-- CSS Files -->
	<?php if (isset($styles)): ?>
		<?php foreach ($styles as $style): ?>
			<link rel="stylesheet" href="<?=asset('css/'.$style.'.css')?>">
		<?php endforeach ?>
		<?php unset($styles); ?>
	<?php endif ?>

</head>

<body class="body-content">
<main class="main-content">