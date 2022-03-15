<a href="<?= base_url('admin') ?>">Dashboard</a>
<hr>
<h1 class="text-center"><?= $judul ?></h1>
<div class="table-responsive" style="padding: 20px;">
	<table id="tb-suplier" class="table table-sm table-hover table-striped table-bordered" style="width: 100%;">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Id</th>
				<th>Perusahaan</th>
				<th>Pemilik</th>
				<th>Alamat</th>
				<th>Kontak</th>
				<th class="text-center">+</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<div style="padding: 5px 20px;">
	<a id="tambah" href="#" class="btn btn-success"><i class="fa fa-plus"></i> Tambah <?= $judul ?></a>
</div>
<div class="my-form-controller" id="tambah-form">
	<div class="my-form-controller-scroll">
		<div class="my-form-controller-wrapper">
			<h1 class="text-right">Tambah <?= $judul ?></h1>
			<form action="<?= base_url('master_suplier/tambah') ?>" method="post">
				<div class="form-row form-group">
					<div class="col">
						<label>Perusahaan</label>
						<input <?php autoff() ?> type="text" name="perusahaan" id="autofocus" class="form-control" placeholder="Masukan perusahaan suplier">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Pemilik</label>
						<input <?php autoff() ?> type="text" name="pemilik" class="form-control" placeholder="Masukan pemilik suplier">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Alamat</label>
						<input <?php autoff() ?> type="text" name="alamat" class="form-control" placeholder="Masukan alamat suplier">						
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Kontak</label>
						<input <?php autoff() ?> type="text" name="kontak" class="form-control" placeholder="Masukan kontak suplier">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<button class="btn btn-primary" type="submit">
							<i class="fa fa-save"></i> Simpan <?= $judul ?>
						</button>
						<button id="tutup-tambah" class="btn btn-danger" type="button">
							<i class="fa fa-times"></i> Batal
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="my-form-controller" id="ubah-form">
	<div class="my-form-controller-scroll">
		<div class="my-form-controller-wrapper">
			<h1 class="text-right">Ubah <?= $judul ?></h1>
			<form action="<?= base_url('master_suplier/ubah') ?>" method="post">
				<input type="hidden" name="id" id="id">
				<div class="form-row form-group">
					<div class="col">
						<label>Perusahaan</label>
						<input <?php autoff() ?> type="text" name="perusahaan" id="perusahaan" class="form-control" placeholder="Masukan perusahaan suplier">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Pemilik</label>
						<input <?php autoff() ?> type="text" name="pemilik" id="pemilik" class="form-control" placeholder="Masukan pemilik suplier">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Alamat</label>
						<input <?php autoff() ?> type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan alamat suplier">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Kontak</label>
						<input <?php autoff() ?> type="text" name="kontak" id="kontak" class="form-control" placeholder="Masukan kontak suplier">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<button class="btn btn-warning" type="submit">
							<i class="fa fa-save"></i> Simpan Perubahan <?= $judul ?>
						</button>
						<button id="tutup-ubah" class="btn btn-danger" type="button">
							<i class="fa fa-times"></i> Batal
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>