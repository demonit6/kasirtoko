<div class="table-responsive" style="padding: 20px;">
	<table id="tb-stok" class="table table-sm table-bordered" style="width: 100%;">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Id</th>
				<th>Id List / Inventory</th>
				<th>Jenis</th>
				<th>Barang</th>
				<th>Total Barang</th>
				<th>Expired State</th>
				<th>Expired Date</th>
				<th>Harga Jual</th>
				<th>+</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<div class="my-form-controller" id="addcheckout-form">
	<div class="my-form-controller-scroll">
		<div class="my-form-controller-wrapper">
			<h1 class="text-right">Add Chekcout <?= $judul ?></h1>
			<form action="<?= base_url('penjualan/checkout_add') ?>" method="post">
				<input type="hidden" name="id_l" id="id_l">
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
						<label>Harga Jual</label>
						<input style="text-align: right;" type="text" id="disp" class="form-control" disabled="">
						<input type="hidden" name="harga_jual" id="harga-jual">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<label>Jumlah Beli</label>
						<input type="number" id="jumlah-beli" name="jumlah_beli" class="form-control" placeholder="Masukan jumlah beli" min="0" value="0">
						<input type="hidden" name="total_barang" id="total-barang">
					</div>
				</div>
				<div class="form-row form-group">
					<div class="col">
						<button class="btn btn-primary" type="submit">
							<i class="fa fa-save"></i> Simpan <?= $judul ?>
						</button>
						<button id="tutup-addcheckout" class="btn btn-danger" type="button">
							<i class="fa fa-times"></i> Batal
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>