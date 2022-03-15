<a href="<?= base_url('admin') ?>">Dashboard</a>
<hr>
<h1 class="text-center"><?= $judul ?></h1>
<div class="laporan-wrapper">
	<h1>Berdasarkan Tanggal</h1>
	<form action="<?= base_url('laporan_penjualan/berdasarkan_tanggal') ?>" method="post">
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