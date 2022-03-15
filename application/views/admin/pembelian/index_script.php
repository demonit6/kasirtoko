<script type="text/javascript" src="<?= base_url('public_html/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/selectize.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public_html/flatpickr.min.js') ?>"></script>
<script type="text/javascript">
	var today = new Date();
	var yesterday = new Date();
	yesterday.setDate(today.getDate() - 1); 
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
		$('select').selectize();
		$('#tambah-keranjang-pembelian').click(function(e){
			e.preventDefault();
			$('body').css({'overflow-y':'hidden'});
			$('#tambah-keranjang-pembelian-form').css({'display':'block'});
			$('#autofocus').focus();
		});
		$('#tutup-tambah-keranjang-pembelian').click(function(e){
			$('body').css({'overflow-y':'auto'});
			$('#tambah-keranjang-pembelian-form').css({'display':'none'});
		});
		$('#total-barang').on('keyup', function(event){
			var a = $('#disp').val().replace('Rp. ','').replace(/\./g,'');
			var b = parseInt(eval($(this).val())) * parseInt(a);
			$('#disp2').val(formatRupiah(b.toString()));
		});
		$('#disp').on('keyup', function(event){
			$(this).val(formatRupiah($(this).val()));
			var a = eval($('#total-barang').val());
			var b = $(this).val().replace('Rp. ','').replace(/\./g,'');
			var c = parseInt(a) * parseInt(b);
			$('#harga-beli').val(b);
			$('#disp2').val(formatRupiah(c.toString()));
			// console.log(window.getSelection().getRangeAt(0).startOffset);
			// var dig = event.which || event.keyCode;
			// if(dig == 48) $(this).val('0');
			// if(dig == 49) $(this).val('1');
			// if(dig == 50) $(this).val('2');
			// if(dig == 51) $(this).val('3');
			// if(dig == 52) $(this).val('4');
			// if(dig == 53) $(this).val('5');
			// if(dig == 54) $(this).val('6');
			// if(dig == 55) $(this).val('7');
			// if(dig == 56) $(this).val('8');
			// if(dig == 57) $(this).val('9');
		});
		$('#exp_d').flatpickr({
			enableTime: false,
			enableSeconds: false,
			altInput: true,
			allowInput: false,
			time_24hr: true,
			inline: false,
			minDate: Date.now(),
			altFormat: "F j Y, H:i:s",
			dateFormat: "Y-m-d H:i:s",
		});
		var table = $('#tb-keranjang-pembelian').DataTable({
			"language": {
				"url": "<?php echo base_url('public_html/') ?>Indonesian.json"
			},
			"responsive": false,
			"processing": true,
			"serverSide": false,
			"ordering": true,
			"order": [[ 0, 'desc' ]],
			"lengthMenu": [25, 50, 100, 1, 2, 3, 4, 5, 10],
			"deferRender": true,
			"columnDefs":[
				{
					"targets": [0,1,2,3,4,5,6,7,8,9],
					"orderable": false
				}
			]
		});
		$('.hapus').click(function(row){
			return confirm('Yakin akan menghapus item dengan nomor : '+$(this).attr('id')+'?');
		});
		$('#exec-keranjang-pembelian').click(function(row){
			return confirm('Pembelian akan diproses! sudah yakinkah anda?');
		});
		$('#empty-keranjang-pembelian').click(function(row){
			return confirm('Keranjang akan dikosongkan, yakin ingin mengosongkan keranjang?');
		});
	});
</script>