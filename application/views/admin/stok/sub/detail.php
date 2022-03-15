<div class="table-responsive" style="padding: 20px;">
	<table id="tb-stok" class="table table-sm table-bordered" style="width: 100%;">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Id</th>
				<th>Id List / Inventory</th>
				<th>Suplier</th>
				<th>Jenis</th>
				<th>Barang</th>
				<th>Total Barang</th>
				<th>Expired State</th>
				<th>Expired Date</th>
				<th>+</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<div class="my-form-controller" id="retur-form">
	<div class="my-form-controller-scroll">
		<div class="my-form-controller-wrapper">
			<h1 class="text-right">Retur <?= $judul ?></h1>
			<form action="<?= base_url('stok/retur') ?>" method="post">
				<input type="hidden" name="id" id="id">
				<input type="hidden" name="id_l" id="id-l">
				<div class="form-row form-group">
					<div class="col">
						<label>Suplier</label>
						<input <?php autoff() ?> type="text" name="suplier" id="suplier" class="form-control" readonly="">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Jenis</label>
						<input <?php autoff() ?> type="text" name="jenis" id="jenis" class="form-control" readonly="">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Barang</label>
						<input <?php autoff() ?> type="text" name="barang" id="barang" class="form-control" readonly="">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Total Barang</label>
						<input <?php autoff() ?> type="number" name="total_barang" id="total-barang" min="1" class="form-control">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<button class="btn btn-primary" type="submit">
							<i class="fa fa-save"></i> Ajukan Retur
						</button>
						<button id="tutup-retur" class="btn btn-danger" type="button">
							<i class="fa fa-times"></i> Batal
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="my-form-controller" id="ubah-stok-form">
	<div class="my-form-controller-scroll">
		<div class="my-form-controller-wrapper">
			<h1 class="text-right">Ubah <?= $judul ?></h1>
			<form action="<?= base_url('stok/ubah_stok') ?>" method="post">
				<input type="hidden" name="id" id="id-us">
				<input type="hidden" name="id_l" id="id-l-us">
				<div class="form-row form-group">
					<div class="col">
						<label>Suplier</label>
						<input <?php autoff() ?> type="text" id="suplier-us" class="form-control" disabled="">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Jenis</label>
						<input <?php autoff() ?> type="text" id="jenis-us" class="form-control" disabled="">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Barang</label>
						<input <?php autoff() ?> type="text" id="barang-us" class="form-control" disabled="">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Total Barang</label>
						<input <?php autoff() ?> type="number" name="total_barang" id="total-barang-us" class="form-control">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<button class="btn btn-primary" type="submit">
							<i class="fa fa-save"></i> Simpan Stok
						</button>
						<button id="tutup-ubah-stok" class="btn btn-danger" type="button">
							<i class="fa fa-times"></i> Batal
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>