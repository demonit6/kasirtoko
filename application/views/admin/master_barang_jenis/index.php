<a href="<?= base_url('admin') ?>">Dashboard</a>
<hr>
<h1 class="text-center"><?= $judul ?></h1>
<div class="table-responsive" style="padding: 20px;">
	<table id="tb-barang-jenis" class="table table-sm table-hover table-striped table-bordered" style="width: 100%;">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Id</th>
				<th>Nama</th>
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
			<form action="<?= base_url('master_barang_jenis/tambah') ?>" method="post">
				<div class="form-row form-group">
					<div class="col">
						<label>Nama</label>
						<input <?php autoff() ?> type="text" name="nama" id="autofocus" class="form-control" placeholder="Masukan nama barang jenis">
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
			<form action="<?= base_url('master_barang_jenis/ubah') ?>" method="post">
				<input type="hidden" name="id" id="id">
				<div class="form-row form-group">
					<div class="col">
						<label>Nama</label>
						<input <?php autoff() ?> type="text" name="nama" id="nama" class="form-control" placeholder="Masukan nama barang jenis">
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