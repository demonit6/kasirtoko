<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Masuk - <?= $nama_toko ?></title>
	<link href="<?= base_url('public_html/barlow.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('public_html/bootstrap.min.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('public_html/my.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('public_html/font-awesome-4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet" />
	<style type="text/css">

*{
	margin: 0;
	padding: 0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-ms-box-sizing: border-box;
	-o-box-sizing: border-box;
	box-sizing: border-box;
}
#login{
	padding: 10px 20px;
	max-width: 360px;
	margin: auto;
	display: block;
}
#log-ico{
	color: #1880C6;
	font-size: 75px;
}
#wrap-ucapan{
	padding: 10px;
	text-align: center;
	display: block;
	width: 100%;
	background-color: #000000;
	color: #FFFFFF;
	border-radius: 5px;
	position: relative;
}
#tutup-ucapan{
	position: absolute;
	right: 0;
	top: -40px;
	color: #F31637;
	font-size: 30px;
	cursor: pointer;
}
#tutup-ucapan:hover{
	color: #F39B16;
}

		
	</style>
</head>
<body>
<div id="login">
	<form action="<?= base_url('login/tryLogin') ?>" method="post">
		<fieldset>
			<legend><div id="log-ico" class="text-center"><i class="fa fa-user-circle-o"></i></div></legend>
			<?php if($ucapan_status == 'tampil'){ ?>
			<div id="ucapan" class="form-group form-row">
				<div id="wrap-ucapan">
					<?= $ucapan ?>
					<div id="tutup-ucapan"><i class="fa fa-window-close-o"></i></div>
				</div>
			</div>
			<?php } ?>

			<div class="form-group form-row">
				<input <?php autoff() ?> id="user-id" type="text" name="user_id" class="form-control form-control-sm" placeholder="Masukan nama pengguna">
			</div>
			<div class="form-group form-row">
				<input <?php autoff() ?> type="password" name="user_password" class="form-control form-control-sm" placeholder="Masukan password pengguna">
			</div>
			<div class="form-group form-row">
				<div class="col text-center">
					<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-power-off"></i> login</button>
					<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-superpowers"></i> reset</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<script type="text/javascript">
	document.getElementById('user-id').focus();
	var close = document.getElementById('tutup-ucapan') || null;
	if(close != null){
		close.onclick = function(){
			var c = document.getElementById('ucapan');
			c.style.display = 'none';
		}
	}
</script>
</body>
</html>