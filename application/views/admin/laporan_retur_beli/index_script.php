<script type="text/javascript" src="<?= base_url('public_html/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript">
	var bulan_indo = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
	$(document).ready(function(){
		var table = $('#tb-retur').DataTable({
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
				"url": "<?php echo base_url('laporan_retur_beli/ajax_index') ?>",
				"type": "POST"
			},
			"columns":[
				{
					"data":null,
					"render":function(data, type, row, meta){
						return meta.row + 1;
					}
				},
				{"data":"id"},
				{"data":"id_l"},
				{"data":"suplier"},
				{"data":"jenis"},
				{"data":"barang"},
				{"data":"total_barang"},
				{
					"data":null,
					"render":function(data, type, row, meta){
						var tgl = row['tgl'];
						var nd = new Date(tgl);
						var dd = nd.getDate();
						var mm = nd.getMonth();
						var yy = nd.getFullYear();
						return dd + ' ' + bulan_indo[mm] + ' ' + yy;
					}
				},
				{
					"data":null,
					"render":function(data, type, row, meta){
						var r = '<a class="btn btn-success btn-sm" href="<?= base_url('laporan_retur_beli/cetak/') ?>'+row['id']+'"><i class="fa fa-print"></i></a>';
						return r;
					}
				}
			],
			"columnDefs":[
				{
					"targets": [0,3,4,5,6,7,8],
					"orderable": false
				}
			]
		});
	});
</script>