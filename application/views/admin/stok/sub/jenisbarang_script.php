<script type="text/javascript" src="<?= base_url('public_html/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var table = $('#tb-jenis-barang').DataTable({
			"language": {
				"url": "<?php echo base_url('public_html/') ?>Indonesian.json"
			},
			"responsive": false,
			"processing": true,
			"serverSide": true,
			"ordering": true,
			"order": [[ 1, 'desc' ]],
			"lengthMenu": [25, 50, 100, 5, 10],
			"deferRender": true,
			"ajax":{
				"url": "<?php echo base_url('stok/ajax_jenisbarang') ?>",
				"type": "POST"
			},
			"columns":[
				{
					"data":null,
					"render":function(data, type, row, meta){
						return meta.row + 1;
					}
				},
				{"data":"jenis"},
				{"data":"barang"},
				{
					"data":null,
					"render":function(data, type, row, meta){
						return '<span class="total-barang">'+row['stok']+'</span>';
					}
				}
			],
			"columnDefs":[
				{
					"targets": [0,3],
					"orderable": false
				}
			]
		});
		table.on('draw', function(){
			var ttt = 0;
			$('.total-barang').each(function(){
				ttt += parseInt($(this).text());
				console.log(ttt);
			});
		});
	});
</script>