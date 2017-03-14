</main>
<footer>
	
</footer>

	<!--   Dynamic JS load   -->
	<?php if (isset($scripts)): ?>
		<?php foreach ($scripts as $script): ?>
			<script src="<?=asset('js/'.$script.'.js')?>"></script>
		<?php endforeach ?>
		<?php unset($scripts); ?>
	<?php endif ?>

	<?php if (isset($js)): ?>
		<script>
			<?=$js?>
		</script>
	<?php endif ?>

</body>
</html>