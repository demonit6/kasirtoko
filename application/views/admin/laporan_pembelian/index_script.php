<script type="text/javascript" src="<?= base_url('public_html/selectize.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/flatpickr.min.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('select').selectize();
		$('.tgl').flatpickr({
			enableTime: false,
			enableSeconds: false,
			altInput: true,
			allowInput: false,
			time_24hr: true,
			inline: false,
			altFormat: "F j Y, H:i:s",
			dateFormat: "Y-m-d H:i:s",
		});
	});
</script>