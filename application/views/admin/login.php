<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en" class="pannel-toolbar">
<head>
	<meta charset="utf-8">
	<title>ATENCIÓN TÉCNICA CLARO</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style.css">
	<link rel="stylesheet" href="<?=base_url()?>css/font-awesome.min.css">
	<script src="<?=base_url()?>encuestas/js/jquery-1.9.1.min.js"></script>
</head>
<body>

	<div id="container">
		<header>
			<div class="header-inner">
				<h1 style="float: left;">Bienvenidos al administrador de Solicitudes</h1>
			</div>
		</header>
		<div class="right-list-admin">

		</div>
		<div class="right-content">	
			<div class="list-mod-panel">
				<form class="btnf" method="POST" action="<?=base_url()?>index.php/admin/set_session">
					Nombre de Usuario
					<br>
					<br>
					<input type="text" name="session_value"/>
					<br>
					Contraseña
					<br>
					<br>
					<input type="password" name="session_pass"/>
					<br><br>
					<input class="btn" type="submit" value="Entrar">
					<?=(@$error)?'<br><br><b>Datos Incorrectos</b>':''?>
					<br>
					<b><a href="<?=base_url()?>index.php/admin/olvidoclave">¿Olvidó su Contraseña?</a></b>
				</form>
			</div>
		</div>
	</div>

</body>
</html>