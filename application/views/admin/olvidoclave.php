<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en" class="pannel-toolbar">
<head>
	<meta charset="utf-8">
	<title>ATENCIÓN TÉCNICA CLARO</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style.css">
	<link rel="stylesheet" href="<?=base_url()?>css/font-awesome.min.css">
	<script src="<?=base_url()?>encuesta/js/jquery-1.9.1.min.js"></script>
	<script>
		function revisar() {
			if ( $("#search").val() )
				alert('¡Revisa Tu Correo!');
			else
				alert('¡Coloca tu Usuario o Correo!')
		}
	</script>
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
				<form class="btnf" method="POST">
					Nombre de Usuario o Correo Electrónico
					<br>
					<br>
					<input type="text" id="search" name="search"/>
					<br><br>
					<input class="btnsearch" type="submit" value="Contraseña Nueva" onclick="revisar();">
					<hr>
					<b><a href="<?=base_url()?>index.php/admin">INGRESAR</a></b>
				</form>
			</div>
		</div>
	</div>

</body>
</html>