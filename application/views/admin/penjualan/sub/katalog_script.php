<script type="text/javascript" src="<?= base_url('public_html/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript">
	function isEmpty(obj){
		for(var key in obj){
			if(obj.hasOwnProperty(key))
				return false;
		}
		return true;
	}
	var bulan_indo = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
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
				"url": "<?php echo base_url('penjualan/ajax_index') ?>",
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
				{"data":"jenis"},
				{"data":"barang"},
				{
					"data":null,
					"render":function(data, type, row, meta){
						var aaaa = row['total_barang'];
						<?php
						$a = null;
						if(!empty($sell)){
							$a = $sell;
						}
						?>
						var st = JSON.parse('<?= json_encode($a) ?>');
						if(!isEmpty(st)){
							if(st[row['id_l']]){
								aaaa -= st[row['id_l']].jumlah_beli;
								aaaa = '<span style="color:red;">'+aaaa+'</span>' + ' ('+st[row['id_l']].jumlah_beli+')';
							}
						}
						return '<span class="total-barang">'+aaaa+'</span>';
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
						if(row['harga_jual'] != null){
							return formatRupiah(row['harga_jual']);
						}
						return 'Harga jual belum ada';
					}
				},
				{
					"data":null,
					"render":function(data, type, row, meta){
						var aaaa = row['total_barang'];
						<?php
						$a = null;
						if(!empty($sell)){
							$a = $sell;
						}
						?>
						var st = JSON.parse('<?= json_encode($a) ?>');
						if(!isEmpty(st)){
							if(st[row['id_l']]){
								aaaa -= st[row['id_l']].jumlah_beli;
							}
						}
						var r = '<div class="text-center"><div class="btn-group">';
						r += '<a ';
						r += 'data-id_l="'+row['id_l']+'"';
						r += 'data-jenis="'+row['jenis']+'"';
						r += 'data-barang="'+row['barang']+'"';
						r += 'data-total-barang="'+aaaa+'"';
						r += 'data-total-barang-stok="'+row['total_barang']+'"';
						r += 'data-harga-jual="'+row['harga_jual']+'"';
						r += ' href="#" class="btn btn-sm btn-success tampil-checkout"><i class="fa fa-truck"></i></a>';
						r += '</div></div>';
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
		table.on('draw', function(){
			var max = 0;
			$('.tampil-checkout').click(function(e){
				e.preventDefault();
				$('body').css({'overflow-y':'hidden'});
				$('#addcheckout-form').css({'display':'block'});
				$('#jumlah-beli').focus();
				$('#id_l').val($(this).attr('data-id_l'));
				$('#jenis').val($(this).attr('data-jenis'));
				$('#barang').val($(this).attr('data-barang'));
				$('#disp').val(formatRupiah($(this).attr('data-harga-jual')));
				$('#harga-jual').val($(this).attr('data-harga-jual'));
				$('#jumlah-beli').attr('max', $(this).attr('data-total-barang'));
				$('#total-barang').val($(this).attr('data-total-barang-stok'));
				max = parseInt($(this).attr('data-total-barang'));
			});
			$('#jumlah-beli').on('keyup', function(){
				if(parseInt($(this).val()) > max){
					$(this).val(max);
				}
				if(parseInt($(this).val()) < 0){
					$(this).val('1');
				}
			});
			$('#tutup-addcheckout').click(function(e){
				e.preventDefault();
				$('body').css({'overflow-y':'auto'});
				$('#addcheckout-form').css({'display':'none'});
			});
		});
	});
</script>