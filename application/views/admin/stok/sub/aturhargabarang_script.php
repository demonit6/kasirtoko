<script type="text/javascript" src="<?= base_url('public_html/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript">
	function formatRupiah(angka, prefix = "Rp. "){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split = number_string.split(','),
		sisa = split[0].length % 3,
		rupiah = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
	$(document).ready(function(){
		var table = $('#tb-harga').DataTable({
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
				"url": "<?php echo base_url('stok/ajax_aturhargabarang') ?>",
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
				{"data":"jenis"},
				{"data":"barang"},
				{
					"data":null,
					"render":function(data, type, row, meta){
						return formatRupiah(row['harga_jual']);
					}
				},
				{
					"data":null,
					"render":function(data, type, row, meta){
						var r = '<div class="text-center"><div class="btn-group">';
						r += '<a ';
						r += 'data-id="'+row['id']+'"';
						r += 'data-jenis="'+row['jenis']+'"';
						r += 'data-barang="'+row['barang']+'"';
						r += 'data-harga_jual="'+formatRupiah(row['harga_jual'])+'"';
						r += ' class="btn btn-success btn-sm tampil-form" href="#"><i class="fa fa-dollar"></i></a>';
						r += '<a class="btn btn-danger btn-sm hapus" href="';
						r += '<?= base_url('stok/hapus_harga_barang/') ?>' + row['id'];
						r += '"><i class="fa fa-trash"></i>';
						r += '</a>';
						r += '</div></div>';
						return r;
					}
				}
			],
			"columnDefs":[
				{
					"targets": [0,2,3,4,5],
					"orderable": false
				}
			]
		});
		table.on('draw', function(){
			$('.tampil-form').click(function(e){
				e.preventDefault();
				$('body').css({'overflow-y':'hidden'});
				$('#aturharga-form').css({'display':'block'});
				$('#disp').focus();
				$('#id').val($(this).attr('data-id'));
				$('#jenis').val($(this).attr('data-jenis'));
				$('#barang').val($(this).attr('data-barang'));
				$('#disp').val($(this).attr('data-harga_jual'));
				$('#harga-jual').val($(this).attr('data-harga_jual').replace('Rp. ','').replace(/\./g,''));
			});
			$('#tutup-aturharga').click(function(){
				$('body').css({'overflow-y':'auto'});
				$('#aturharga-form').css({'display':'none'});
			});
			$('#disp').on('keyup', function(){
				$('#harga-jual').val($(this).val().replace('Rp. ','').replace(/\./g,''));
				$(this).val(formatRupiah($(this).val()));
			});
			$('.hapus').click(function(){
				return confirm('Ingin menghapus harga barang ini?');
			});
		});
	});
</script>