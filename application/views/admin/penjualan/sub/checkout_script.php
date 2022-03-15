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
		$('#disp-uang-pembayaran').on('keyup', function(){
			$(this).val(formatRupiah($(this).val()));
			$('#uang-pembayaran').val($(this).val().replace('Rp. ','').replace(/\./g,''));
			var k = parseInt($('#uang-pembayaran').val()) - parseInt($('#jumlah-bayar').val());
			var m = (function(){
				if(parseInt($('#uang-pembayaran').val()) < parseInt($('#jumlah-bayar').val())){
					return '- ';
				}
				return '';
			}());
			$('#disp-uang-kembalian').val(m + formatRupiah(k.toString()));
			$('#uang-kembalian').val(k);
		});
		$('#jual-ok').on('submit', function(){
			if(!$('#uang-pembayaran').val()){
				alert('Masukan Jumlah pembayaran');
				return false;
			}
			if(parseInt($('#uang-pembayaran').val()) < parseInt($('#jumlah-bayar').val())){
				alert('Jumlah pembayaran kurang');
				return false;
			}
			return confirm('Sudah yakin ingin melanjutkan?');
		});
	});
</script>