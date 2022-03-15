<a href="<?= base_url('admin') ?>">Dashboard</a>
<hr>
<h1 class="text-center"><?= $judul ?></h1>
<?php
if(empty($listcheck)){
	echo '<p style="font-size:30px;">Tidak ada peringatan!<i class="fa fa-smile-o"></i></p>';
}
else{
?>
<div class="table-responsive">
	<table class="table table-sm table-bordered">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Id</th>
				<th>Id List / Inventory</th>
				<th>Jenis</th>
				<th>Barang</th>
				<th>Total Barang</th>
				<th>Expired Date</th>
				<th>Info</th>
			</tr>
		</thead>
		<body>
			<?php
			$n = 1;
			foreach ($listcheck as $key => $value) {
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
				echo $value['jenis'];
				echo '	</td>';
				echo '	<td>';
				echo $value['barang'];
				echo '	</td>';
				echo '	<td>';
				echo $value['total_barang'];
				echo '	</td>';
				$value['exp_d'] = explode(' ', $value['exp_d']);
				$value['exp_d'] = $value['exp_d'][0];
				echo '	<td>';
				echo tanggal_indo($value['exp_d']);
				echo '	</td>';
				echo '	<td>';
				echo '<span style="color: red;">'.$value['exp_info'].'</span>';
				echo '	</td>';
				echo '</tr>';
				$n++;
			}
			?>
		</body>
	</table>
</div>
<?php
}
?>