<h1 class="text-center">Selamat datang <?= $this->session->userdata('user_id') ?></h1>
<hr>
<div>
	<div class="row">
		<div class="col-xl-3 col-md-6">
			<div class="card bg-primary text-white mb-4">
				<div class="card-body"><i class="fa fa-group"></i> Master Suplier</div>
				<div class="card-footer d-flex align-items-center justify-content-between">
					<a class="small text-white stretched-link" href="<?= base_url('master_suplier') ?>"><i class="fa fa-plus"></i> Form Master Suplier</a>
					<div class="small text-white"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card bg-warning text-white mb-4">
				<div class="card-body"><i class="fa fa-shopping-basket"></i> Master Barang</div>
				<div class="card-footer d-flex align-items-center justify-content-between">
					<a class="small text-white stretched-link" href="<?= base_url('master_barang') ?>"><i class="fa fa-plus"></i> Form Master Barang</a>
					<div class="small text-white"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card bg-success text-white mb-4">
				<div class="card-body"><i class="fa fa-shopping-cart"></i> Pembelian</div>
				<div class="card-footer d-flex align-items-center justify-content-between">
					<a class="small text-white stretched-link" href="<?= base_url('pembelian') ?>"><i class="fa fa-plus"></i> Form Pembelian</a>
					<div class="small text-white"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card bg-danger text-white mb-4">
				<div class="card-body"><i class="fa fa-dollar"></i> Penjualan</div>
				<div class="card-footer d-flex align-items-center justify-content-between">
					<a class="small text-white stretched-link" href="<?= base_url('penjualan') ?>"><i class="fa fa-plus"></i> Form Penjualan</a>
					<div class="small text-white"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xl-3 col-md-6">
			<div class="card bg-c-1 text-white mb-4">
				<div class="card-body"><i class="fa fa-file-text"></i> Laporan Retur Beli</div>
				<div class="card-footer d-flex align-items-center justify-content-between">
					<a class="small text-white stretched-link" href="<?= base_url('laporan_retur_beli') ?>"><i class="fa fa-plus"></i> Data Laporan Retur Beli</a>
					<div class="small text-white"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card bg-c-2 text-white mb-4">
				<div class="card-body"><i class="fa fa-shopping-bag"></i> Stok</div>
				<div class="card-footer d-flex align-items-center justify-content-between">
					<a class="small text-white stretched-link" href="<?= base_url('stok') ?>"><i class="fa fa-plus"></i> Data Stok</a>
					<div class="small text-white"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card bg-c-3 text-white mb-4">
				<div class="card-body"><i class="fa fa-file-text"></i> Laporan Pembelian</div>
				<div class="card-footer d-flex align-items-center justify-content-between">
					<a class="small text-white stretched-link" href="<?= base_url('laporan_pembelian') ?>"><i class="fa fa-plus"></i> Data Laporan Pembelian</a>
					<div class="small text-white"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-md-6">
			<div class="card bg-c-4 text-white mb-4">
				<div class="card-body"><i class="fa fa-file-text"></i> Laporan Penjualan</div>
				<div class="card-footer d-flex align-items-center justify-content-between">
					<a class="small text-white stretched-link" href="<?= base_url('laporan_penjualan') ?>"><i class="fa fa-plus"></i> Data Laporan Penjualan</a>
					<div class="small text-white"><i class="fa fa-angle-right"></i></div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
<div class="sp sp-line sp-green"></div>
<h1 class="color-green text-center">Pembelian Hari Ini</h1>
<div class="table-responsive">
	<table class="table table-sm table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Id</th>
				<th>Id List / Inventory</th>
				<th>Suplier</th>
				<th>Jenis</th>
				<th>Barang</th>
				<th>Total Barang</th>
				<th>Harga Beli</th>
				<th>Total Harga Beli</th>
				<th>Expired State</th>
				<th>Expired Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($laporan_pembelian)){
			$n = 1;
			$stb = 0;
			$sth = 0;
			foreach ($laporan_pembelian as $key => $value) {
				echo '<tr>';
				echo '	<td>';
				echo $n;
				echo '	</td>';
				echo '	<td>';
				echo $value['id'];
				echo '	</td>';
				echo '	<td>';
				echo $value['id_l'];
				echo '	</td>';
				echo '	<td>';
				echo $value['suplier'];
				echo '	</td>';
				echo '	<td>';
				echo $value['jenis'];
				echo '	</td>';
				echo '	<td>';
				echo $value['barang'];
				echo '	</td>';
				echo '	<td>';
				echo $value['total_barang'];
				echo '	</td>';
				echo '	<td>';
				echo formatRupiah($value['harga_beli']);
				echo '	</td>';
				echo '	<td>';
				echo formatRupiah($value['total_harga_beli']);
				echo '	</td>';
				echo '	<td>';
				echo $value['exp_s'];
				echo '	</td>';
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
				echo '</tr>';
				$n++;
				$stb += $value['total_barang'];
				// $sth += $value['total_barang'] * $value['harga_beli'];
				$sth += $value['total_harga_beli'];
			}
		}
		else{
			echo '<tr><td colspan="11" style="text-align: center;">Tidak ada data yang tersedia pada tabel ini
</td></tr>';
		}
		?>
		</tbody>
		<?php
		if(!empty($laporan_pembelian)){
			echo '<tfoot>';
			echo '	<tr>';
			echo '		<td colspan="6" style="text-align: center;"><b>Sub total barang</b></td>';
			echo '		<td><b>'.$stb.'</b></td>';
			echo '		<td><b>Sub total harga</b></td>';
			echo '		<td colspan="3"><b>'.formatRupiah($sth).'</b></td>';
			echo '	</tr>';
			echo '</tfoot>';
		}
		?>
	</table>
</div>
<div class="sp sp-line sp-blue"></div>
<h1 class="color-blue text-center">Penjualan Hari Ini</h1>
<div class="table-responsive">
	<table class="table table-sm table-bordered table-striped table-hover table-dark">
		<thead>
			<tr>
				<th>No</th>
				<th>Id</th>
				<th>Pembeli</th>
				<th>Jumlah Bayar</th>
				<th>Uang Pembayaran</th>
				<th>Uang Kembalian</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($laporan_penjualan)){
				$n = 1;
				$stb = 0;
				$sth = 0;
				foreach ($laporan_penjualan as $key => $value) {
					echo '<tr>';
					echo '	<td>';
					echo $n;
					echo '	</td>';
					echo '	<td>';
					echo $value['id'];
					echo '	</td>';
					echo '	<td>';
					echo $value['pembeli'];
					echo '	</td>';
					echo '	<td>';
					echo formatRupiah($value['jumlah_bayar']);
					echo '	</td>';
					echo '	<td>';
					echo formatRupiah($value['uang_pembayaran']);
					echo '	</td>';
					echo '	<td>';
					echo formatRupiah($value['uang_kembalian']);
					echo '	</td>';
					echo '</tr>';
					$n++;
					$sth += $value['jumlah_bayar'];
				}
			}
			else{
				echo '<tr><td colspan="6" style="text-align: center;">Tidak ada data yang tersedia pada tabel ini
</td></tr>';
			}
			?>
		</tbody>
		<?php
		if(!empty($laporan_penjualan)){
			echo '<tfoot>';
			echo '	<tr>';
			echo '		<td colspan="3" style="text-align: center;"><b>Total</b></td>';
			echo '		<td colspan="3"><b>'.formatRupiah($sth).'</b></td>';
			echo '	</tr>';
			echo '</tfoot>';
		}
		?>
	</table>
</div>
<hr>