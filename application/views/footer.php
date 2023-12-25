</div>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<?php
	if(isset($js)){
		$arrlength = count($js);
		for($x = 0; $x < $arrlength; $x++) {
			echo '<script src="'.base_url() . $js[$x].'"></script>';
		}
	}
	?>
	<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/dropdown-bootstrap-extended.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
	<script type="text/javascript">
      AppHelper = {};
      AppHelper.baseUrl = "<?php echo base_url(); ?>";
    </script>
</body>
</html>
