<div class="table-responsive">
	<table class="table table-sm table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Id List / Inventory</th>
				<th>Jenis</th>
				<th>Barang</th>
				<th>Jumlah Beli</th>
				<th>Sisa Barang / Stok</th>
				<th>Harga Jual</th>
				<th>Total Harga</th>
				<th>+</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($sell)){
				$i = 1;
				$stb = 0;
				$sth = 0;
				foreach ($sell as $key => $value) {
					echo '<tr>';
					echo '	<td>';
					echo $i;
					echo '	</td>';
					echo '	<td>';
					echo $key;
					echo '	</td>';
					echo '	<td>';
					echo $value['jenis'];
					echo '	</td>';
					echo '	<td>';
					echo $value['barang'];
					echo '	</td>';
					echo '	<td>';
					echo $value['jumlah_beli'];
					echo '	</td>';
					echo '	<td>';
					echo '	<span style="color: red;">';
					echo $value['total_barang'];
					echo '	</span>';
					echo '	</td>';
					echo '	<td>';
					echo formatRupiah($value['harga_jual']);
					echo '	</td>';
					echo '	<td>';
					echo formatRupiah($value['jumlah_beli'] * $value['harga_jual']);
					echo '	</td>';
					echo '	<td>';
					echo '	<div class="text-center">';
					echo '		<a href="';
					echo base_url('penjualan/hapus_keranjang/'.$key);
					echo '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
					echo '	</div>';
					echo '	</td>';
					echo '</tr>';
					$i++;
					$stb += $value['jumlah_beli'];
					$sth += $value['jumlah_beli'] * $value['harga_jual']; 
				}
			}
			else{
				echo '<tr>';
				echo '	<td colspan="9" style="text-align:center;">Tidak ada barang';
				echo '	</td>';
				echo '</tr>';
			}
			?>
		</tbody>
		<?php
		if(!empty($sell)){
			echo '<tfoot>';
			echo '<tr>';
			echo '	<td colspan="4" style="text-align:right;">Sub Total Barang';
			echo '	</td>';
			echo '	<td>';
			echo $stb;
			echo '	</td>';
			echo '	<td colspan="2">Sub Total Harga';
			echo '	</td>';
			echo '	<td colspan="2">';
			echo formatRupiah($sth);
			echo '	</td>';
			echo '</tr>';
			echo '</tfoot>';
		}
		?>
	</table>
</div>
<div class="form-row form-group">
	<div class="col">
		<a class="btn btn-danger" href="<?= base_url('penjualan/kosong_keranjang') ?>"><i class="fa fa-trash"></i> Kosongkan Keranjang</a>
	</div>
</div>
<hr>
<form id="jual-ok" action="<?= base_url('penjualan/jual_ok') ?>" method="post">
	<div class="form-row form-group">
		<div class="col">
			<label>Pembeli / Boleh di kosongi</label>
			<input type="text" id="pembeli" name="pembeli" class="form-control" placeholder="Masukan nama pembeli!">
		</div>
	</div>
	<div class="form-row form-group">
		<div class="col">
			<label>Jumlah Bayar</label>
			<input type="text" id="disp-jumlah-bayar" class="form-control" value="<?= formatRupiah(@$sth) ?>" disabled="">
			<input type="hidden" id="jumlah-bayar" name="jumlah_bayar" value="<?= @$sth ?>">
		</div>
	</div>
	<div class="form-row form-group">
		<div class="col">
			<label>Uang / Pembayaran</label>
			<input type="text" style="text-align: right;" id="disp-uang-pembayaran" class="form-control" placeholder="Masukan nominal uang!">
			<input type="hidden" name="uang_pembayaran" id="uang-pembayaran">
		</div>
	</div>
	<div class="form-row form-group">
		<div class="col">
			<label>Kembalian</label>
			<input type="text" style="text-align: right;" id="disp-uang-kembalian" class="form-control" placeholder="Jumlah kembalian" disabled="">
			<input type="hidden" name="uang_kembalian" id="uang-kembalian">
		</div>
	</div>
	<div class="form-row form-group">
		<div class="col">
			<label>Diskon</label>
			<input type="text" id="xxx" class="form-control" placeholder="Diskon / belum di support" disabled="">
		</div>
	</div>
	<div class="form-row form-group">
		<div class="col">
			<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Selesai</button>
		</div>
	</div>
</form>