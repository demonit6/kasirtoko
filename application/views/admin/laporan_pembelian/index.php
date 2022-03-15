<a href="<?= base_url('admin') ?>">Dashboard</a>
<hr>
<h1 class="text-center"><?= $judul ?></h1>
<div class="laporan-wrapper">
	<h1>Berdasarkan Tanggal</h1>
	<form action="<?= base_url('laporan_pembelian/berdasarkan_tanggal') ?>" method="post">
		<div class="form-row form-group">
			<div class="col">
				<input type="text" name="ls_tanggal_awal" class="form-control tgl" placeholder="Masukan tanggal awal">
			</div>
			<div class="col">
				<input type="text" name="ls_tanggal_akhir" class="form-control tgl" placeholder="Masukan tanggal akhir">
			</div>
		</div>
		<div class="form-row form-group">
			<div class="col">
				<button type="submit" class="btn btn-success btn-block"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</form>
</div>
<div class="laporan-wrapper">
	<h1>Berdasarkan Suplier</h1>
	<form action="<?= base_url('laporan_pembelian/berdasarkan_suplier') ?>" method="post">
		<div class="form-row form-group">
			<div class="col">
				<input type="text" name="ld_tanggal_awal" class="form-control tgl" placeholder="Masukan tanggal awal">
			</div>
			<div class="col">
				<input type="text" name="ld_tanggal_akhir" class="form-control tgl" placeholder="Masukan tanggal akhir">
			</div>
		</div>
		<div class="form-row form-group">
			<div class="col">
				<select name="ld_suplier" class="form-control">
					<?php
					foreach ($master_suplier as $key => $value) {
						echo '<option>';
						echo $value['perusahaan'].', '.$value['pemilik'];
						echo '</option>';
					}
					?>
				</select>
			</div>
			<div class="col">
				<button type="submit" class="btn btn-warning btn-block"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</form>
</div>
<div class="laporan-wrapper">
	<h1>Berdasarkan Jenis Dan Barang</h1>
	<form action="<?= base_url('laporan_pembelian/berdasarkan_jenis_dan_barang') ?>" method="post">
		<div class="form-row form-group">
			<div class="col">
				<input type="text" name="lt_tanggal_awal" class="form-control tgl" placeholder="Masukan tanggal awal">
			</div>
			<div class="col">
				<input type="text" name="lt_tanggal_akhir" class="form-control tgl" placeholder="Masukan tanggal akhir">
			</div>
		</div>
		<div class="form-row form-group">
			<div class="col">
				<select name="lt_jenis" class="form-control">
					<?php
					foreach ($master_barang as $key => $value) {
						echo '<option>';
						echo $value['jenis'].' >|< '.$value['nama'];
						echo '</option>';
					}
					?>
				</select>
			</div>
			<div class="col">
				<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i></button>
			</div>
		</div>
	</form>
</div>