<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman tidak ditemukan</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('public_html/barlow.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('public_html/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('public_html/my.css') ?>">
</head>
<body>
	<div style="padding: 15px 10px;">
		404, Halaman tidak ditemukan, <button id="back" class="btn btn-danger btn-sm">Kembali</button>
		<hr>
		<a href="<?= base_url() ?>" class="btn btn-danger btn-sm btn-block">Kembali Login</a>
	</div>
	<script type="text/javascript">
		var back = document.getElementById('back');
		back.onclick = function(){
			history.back();
		}
	</script>
</body>
</html>