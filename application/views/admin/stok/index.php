<a href="<?= base_url('admin') ?>">Dashboard</a>
<hr>
<h1 class="text-center"><?= $judul ?></h1>
<hr>
<div class="row">
	<div class="col">
		<a class="btn btn-primary" href="<?= base_url('stok') ?>"><i class="fa fa-files-o"></i> Detail</a>
		<a class="btn btn-success" href="<?= base_url('stok/jenisbarang') ?>"><i class="fa fa-archive"></i> Jenis Barang</a>
		<a class="btn btn-info" href="<?= base_url('stok/aturhargabarang') ?>"><i class="fa fa-ruble"></i> Atur Harga Barang</a>
	</div>
</div>
<hr>
<?php
if(!empty($sub_part_view)) $this->view($sub_part_view);
?>