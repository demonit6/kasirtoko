<div class="form-row form-group">
	<div class="col">
		<a class="btn btn-warning btn-sm" href="<?= base_url('stok/refresh_daftar_barang') ?>"><i class="fa fa-undo"></i> Refresh Daftar Barang</a>
	</div>
</div>
<div class="table-responsive" style="padding: 20px;">
	<table id="tb-harga" class="table table-sm table-bordered" style="width: 100%;">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Id</th>
				<th>Jenis</th>
				<th>Barang</th>
				<th>Harga Jual</th>
				<th>+</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<div class="my-form-controller" id="aturharga-form">
	<div class="my-form-controller-scroll">
		<div class="my-form-controller-wrapper">
			<h1 class="text-right">Atur Harga <?= $judul ?></h1>
			<form action="<?= base_url('stok/simpan_harga_barang') ?>" method="post">
				<input type="hidden" name="id" id="id">
				<div class="form-row form-group">
					<div class="col">
						<label>Jenis</label>
						<input <?php autoff() ?> type="text" id="jenis" class="form-control" disabled="">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Barang</label>
						<input <?php autoff() ?> type="text" id="barang" class="form-control" disabled="">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Harga Jual</label>
						<input style="text-align: right;" type="text" id="disp" class="form-control" placeholder="Masukan harga jual">
						<input type="hidden" name="harga_jual" id="harga-jual">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<button class="btn btn-primary" type="submit">
							<i class="fa fa-save"></i> Simpan <?= $judul ?>
						</button>
						<button id="tutup-aturharga" class="btn btn-danger" type="button">
							<i class="fa fa-times"></i> Batal
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>