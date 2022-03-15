<a href="<?= base_url('admin') ?>">Dashboard</a>
<hr>
<h1 class="text-center"><?= $judul ?></h1>
<label>Nama Toko</label>
<form action="<?= base_url('admin/settings_save') ?>" method="post">
<div class="row form-group">
	<div class="col">
		<input <?php autoff() ?> class="form-control" type="text" name="nama_toko" value="<?= $nama_toko ?>">
	</div>
	<div class="col col-sm-2">
		<button class="btn btn-success btn-block" type="submit">Ganti Nama Toko</button>
	</div>
</div>
<label>Ucapan Login</label>
<div class="row form-group">
	<div class="col">
		<input <?php autoff() ?> class="form-control" type="text" name="ucapan" value="<?= $ucapan ?>">
	</div>
	<div class="col col-sm-2">
		<button class="btn btn-success btn-block" type="submit">Ganti Ucapan</button>
	</div>
</div>
<label>Ucapan Login Status Tampil</label>
<div class="row form-group">
	<div class="col">
		<select class="form-control" name="ucapan_status">
			<option <?php echo $ucapan_status == 'tampil' ? 'selected=""' : ''; ?>>tampil</option>
			<option <?php echo $ucapan_status == 'sembunyi' ? 'selected=""' : ''; ?>>sembunyi</option>
		</select>
	</div>
	<div class="col col-sm-2">
		<button class="btn btn-success btn-block" type="submit">Ganti Ucapan Status</button>
	</div>
</div>
</form>