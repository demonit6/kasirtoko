<script type="text/javascript" src="<?= base_url('public_html/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tambah').click(function(e){
			e.preventDefault();
			$('body').css({'overflow-y':'hidden'});
			$('#tambah-form').css({'display':'block'});
			$('#autofocus').focus();
		});
		$('#tutup-tambah').click(function(e){
			$('body').css({'overflow-y':'auto'});
			$('#tambah-form').css({'display':'none'});
		});
		var table = $('#tb-suplier').DataTable({
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
				"url": "<?php echo base_url('master_suplier/ajax') ?>",
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
				{"data":"perusahaan"},
				{"data":"pemilik"},
				{"data":"alamat"},
				{"data":"kontak"},
				{
					"data":null,
					"render":function(data, type, row, meta){
						var r = '';
						r += '<div class="text-center">';
						r += '<div class="btn-group">';
						r += '<a ';
						r += 'data-id="' + row['id'] + '"';
						r += 'data-perusahaan="' + row['perusahaan'] + '"';
						r += 'data-pemilik="' + row['pemilik'] + '"';
						r += 'data-alamat="' + row['alamat'] + '"';
						r += 'data-kontak="' + row['kontak'] + '"';
						r += 'href="#" class="btn btn-sm btn-warning ubah"><i class="fa fa-pencil"></i></a>';
						r += '<a id="'+row['id']+'" href="';
						r += '<?= base_url('master_suplier/hapus/') ?>' + row['id'];
						r += '" class="btn btn-sm btn-danger hapus"><i class="fa fa-trash"></i></a>';
						r += '</div>';
						r += '</div>';
						return r;
					}
				}
			],
			"columnDefs":[
				{
					"targets": [0,5,6],
					"orderable": false
				}
			]
		});
		table.on('draw', function(row){
			$('.ubah').click(function(row){
				row.preventDefault();
				$('body').css({'overflow-y':'hidden'});
				$('#ubah-form').css({'display':'block'});
				$('#perusahaan').focus();
				$('#id').val($(this).attr('data-id'));
				$('#perusahaan').val($(this).attr('data-perusahaan'));
				$('#pemilik').val($(this).attr('data-pemilik'));
				$('#alamat').val($(this).attr('data-alamat'));
				$('#kontak').val($(this).attr('data-kontak'));
			});
			$('#tutup-ubah').click(function(e){
				$('body').css({'overflow-y':'auto'});
				$('#ubah-form').css({'display':'none'});
			});
			$('.hapus').click(function(row){
				return confirm('Yakin akan menghapus data suplier dengan id : ' + $(this).attr('id') + '?');
			});
		});
	});
</script>