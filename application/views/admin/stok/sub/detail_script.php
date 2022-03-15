<script type="text/javascript" src="<?= base_url('public_html/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript">
	var bulan_indo = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
	$(document).ready(function(){
		var table = $('#tb-stok').DataTable({
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
				"url": "<?php echo base_url('stok/ajax_index') ?>",
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
				{
					"data":null,
					"render":function(data, type, row, meta){
						return '<span class="total-barang">'+row['total_barang']+'</span>';
					}
				},
				{"data":"exp_s"},
				{
					"data":null,
					"render":function(data, type, row, meta){
						var exp_s = row['exp_s'];
						if(exp_s == 'Ya'){
							var exp_d = row['exp_d'];
							var nd = new Date(exp_d);
							var dd = nd.getDate();
							var mm = nd.getMonth();
							var yy = nd.getFullYear();
							return dd + ' ' + bulan_indo[mm] + ' ' + yy;
						}
						return '';
					}
				},
				{
					"data":null,
					"render":function(data, type, row, meta){
						var r = '<div class="text-center"><div class="btn-group"><a ';
						r += 'data-id="'+row['id']+'"';
						r += 'data-id-l="'+row['id_l']+'"';
						r += 'data-suplier="'+row['suplier']+'"';
						r += 'data-jenis="'+row['jenis']+'"';
						r += 'data-barang="'+row['barang']+'"';
						r += 'data-total-barang="'+row['total_barang']+'"';
						r += ' class="btn btn-sm btn-success retur" href="#"><i class="fa fa-undo"></i> Retur</a>';
						r += '<a ';
						r += 'data-id="'+row['id']+'"';
						r += 'data-id-l="'+row['id_l']+'"';
						r += 'data-suplier="'+row['suplier']+'"';
						r += 'data-jenis="'+row['jenis']+'"';
						r += 'data-barang="'+row['barang']+'"';
						r += 'data-total-barang="'+row['total_barang']+'"';
						r += ' class="btn btn-sm btn-warning ubah-stok" href="#"><i class="fa fa-exchange"></i> Ubah Stok</a></div></div>';
						return r;
					}
				}
			],
			"columnDefs":[
				{
					"targets": [0,3,4,5,6,7,8,9],
					"orderable": false
				}
			]
		});
		table.on('draw', function(row){
			var max = 0;
			$('.retur').click(function(row){
				row.preventDefault();
				$('body').css({'overflow-y':'hidden'});
				$('#retur-form').css({'display':'block'});
				$('#total-barang').focus();
				$('#id').val($(this).attr('data-id'));
				$('#id-l').val($(this).attr('data-id-l'));
				$('#suplier').val($(this).attr('data-suplier'));
				$('#jenis').val($(this).attr('data-jenis'));
				$('#barang').val($(this).attr('data-barang'));
				$('#total-barang').val($(this).attr('data-total-barang'));
				$('#total-barang').attr('max', $(this).attr('data-total-barang'));
				max = parseInt($(this).attr('data-total-barang'));
			});
			$('#total-barang').on('keyup', function(){
				if(parseInt($(this).val()) > max){
					$(this).val(max);
				}
				if(parseInt($(this).val()) == 0){
					$(this).val('1');
				}
				if(parseInt($(this).val()) < 0){
					$(this).val('1');
				}
			});
			$('#tutup-retur').click(function(row){
				row.preventDefault();
				$('body').css({'overflow-y':'auto'});
				$('#retur-form').css({'display':'none'});
			});
			$('.ubah-stok').click(function(row){
				row.preventDefault();
				if(confirm("Yakin ingin mengubah stok ini?") == true) {
					$('body').css({'overflow-y':'hidden'});
					$('#ubah-stok-form').css({'display':'block'});
					$('#total-barang-us').focus();
					$('#id-us').val($(this).attr('data-id'));
					$('#id-l-us').val($(this).attr('data-id-l'));
					$('#suplier-us').val($(this).attr('data-suplier'));
					$('#jenis-us').val($(this).attr('data-jenis'));
					$('#barang-us').val($(this).attr('data-barang'));
					$('#total-barang-us').val($(this).attr('data-total-barang'));
					return true;
				}
				else{
					return false;
				}
			});
			$('#tutup-ubah-stok').click(function(row){
				row.preventDefault();
				$('body').css({'overflow-y':'auto'});
				$('#ubah-stok-form').css({'display':'none'});
			});
			var ttt = 0;
			$('.total-barang').each(function(){
				ttt += parseInt($(this).text());
				console.log(ttt);
			});
		});
	});
</script>