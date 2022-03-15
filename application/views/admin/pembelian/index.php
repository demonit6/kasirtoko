<a href="<?= base_url('admin') ?>">Dashboard</a>
<hr>
<h1 class="text-center"><?= $judul ?></h1>
<div class="table-responsive" style="padding: 20px;">
	<table id="tb-keranjang-pembelian" class="table table-sm table-hover table-striped table-bordered" style="width: 100%;">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Suplier</th>
				<th>Jenis</th>
				<th>Barang</th>
				<th>Total Barang</th>
				<th>Harga Beli</th>
				<th>Total Harga Beli</th>
				<th>Expired-Stat</th>
				<th>Expired-Dates</th>
				<th class="text-center">+</th>
			</tr>
		</thead>
		<tbody>
			<?php
if(!empty($shop)){
	$i = 1;
	$stb = 0;
	$sth = 0;
	foreach ($shop as $key => $value) {
		echo '<tr>';
		echo 	'<td>';
		echo 		$i;
		echo 	'</td>';
		echo 	'<td>';
		echo $value['suplier'];
		echo 	'</td>';
		echo 	'<td>';
		echo $value['jenis'];
		echo 	'</td>';
		echo 	'<td>';
		echo $value['barang'];
		echo 	'</td>';
		echo 	'<td>';
		echo $value['total_barang'];
		echo 	'</td>';
		echo 	'<td>';
		echo formatRupiah($value['harga_beli']);
		echo 	'</td>';
		echo 	'<td>';
		echo formatRupiah($value['total_harga_beli']);
		echo 	'</td>';
		echo 	'<td>';
		echo $value['exp_s'];
		echo 	'</td>';
		if($value['exp_s'] == 'Ya'){
			$value['exp_d'] = explode(' ', $value['exp_d']);
			$value['exp_d'] = $value['exp_d'][0];
			echo '	<td>';
			echo tanggal_indo($value['exp_d']);
			echo '	</td>';
		}
		else{
			echo '	<td>';
			echo '	</td>';
		}
		echo 	'<td>';
		echo 		'<div class="text-center">';
		echo 			'<div class="btn-group">';
		echo 				'<a id="'.($i).'" href="'.base_url('pembelian/hapus/').($i - 1).'" class="btn btn-danger btn-sm hapus"><i class="fa fa-trash"></i></a>';
		echo 			'</div>';
		echo 		'</div>';
		echo 	'</td>';
		echo '</tr>';
		$i++;
		$stb += $value['total_barang'];
		// $sth += $value['total_barang'] * $value['harga_beli'];
		$sth += $value['total_harga_beli'];
	}
}
			?>
		</tbody>
				<?php
		if(!empty($shop)){
			echo '<tfoot>';
			echo '	<tr>';
			echo '		<td></td>';
			echo '		<td></td>';
			echo '		<td></td>';
			echo '		<td><b>Sub total barang</b></td>';
			echo '		<td><b>'.$stb.'</b></td>';
			echo '		<td><b>Sub total harga</b></td>';
			echo '		<td><b>'.formatRupiah($sth).'</b></td>';
			echo '		<td></td>';
			echo '		<td></td>';
			echo '		<td></td>';
			echo '	</tr>';
			echo '</tfoot>';
		}
		?>
	</table>
</div>
<div style="padding: 5px 20px;">
	<a id="tambah-keranjang-pembelian" href="#" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Keranjang <?= $judul ?></a>
	<a id="exec-keranjang-pembelian" href="<?= base_url('pembelian/selesai') ?>" class="btn btn-primary"><i class="fa fa-save"></i> Selesai <?= $judul ?></a>
	<a id="empty-keranjang-pembelian" href="<?= base_url('pembelian/kosong_keranjang') ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Kosongkan Kerajang <?= $judul ?></a>
</div>
<div class="my-form-controller" id="tambah-keranjang-pembelian-form">
	<div class="my-form-controller-scroll">
		<div class="my-form-controller-wrapper">
			<h1 class="text-right">Tambah Keranjang <?= $judul ?></h1>
			<form action="<?= base_url('pembelian/tambah') ?>" method="post">
				<div class="form-row form-group">
					<div class="col">
						<label>Suplier</label>
						<select name="suplier" class="form-control">
							<?php
								foreach ($master_suplier as $key => $value) {
									echo '<option>';
									echo $value['perusahaan'].', '.$value['pemilik'];
									echo '</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Barang</label>
						<select name="barang" class="form-control">
							<?php
								foreach ($master_barang as $key => $value) {
									echo '<option>';
									echo $value['jenis'].' >|< '.$value['nama'];
									echo '</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Total Barang</label>
						<input type="text" name="total_barang" class="form-control" id="total-barang" placeholder="Masukan total barang">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Harga Beli</label>
						<input <?php autoff() ?> type="text" id="disp" class="form-control" style="text-align: right;" placeholder="Masukan harga beli per barang">
						<input type="hidden" name="harga_beli" id="harga-beli">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Total Harga Beli</label>
						<input type="text" id="disp2" class="form-control" style="text-align: right;" placeholder="Total harga beli" disabled="">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Expired-Stat</label>
						<select name="exp_s" class="form-control">
							<option>Tidak</option>
							<option>Ya</option>
						</select>
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Expired-Dates</label>
						<input type="text" name="exp_d" id="exp_d" class="form-control">
					</div>
				</div>
				<hr>
				<div class="form-row form-group">
					<div class="col">
						<button class="btn btn-primary" type="submit">
							<i class="fa fa-save"></i> Simpan Keranjang <?= $judul ?>
						</button>
						<button id="tutup-tambah-keranjang-pembelian" class="btn btn-danger" type="button">
							<i class="fa fa-times"></i> Batal
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>