<a href="<?= base_url('admin') ?>">Dashboard</a>
<hr>
<h1 class="text-center"><?= $judul ?> / Kasir</h1>
<div id="boxer-wrapper">
	<a href="<?= base_url('penjualan') ?>">Katalog</a>
	<a href="<?= base_url('penjualan/checkout') ?>">CheckOut</a>
	<hr>
	<div id="boxer">
<?php
if(!empty($sub_part_view)) $this->view($sub_part_view);
?>
	</div>
</div>