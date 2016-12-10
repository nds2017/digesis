<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>encuesta/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

		<script src="<?=base_url()?>encuesta/js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="<?=base_url()?>encuesta/js/jquery-ui.js" type="text/javascript"></script>
		<script src="<?=base_url()?>encuesta/js/ui-front.js" type="text/javascript"></script>

	</head>

	<body>
		<div class="wrapper">
			<header><a href="<?=base_url()?>"><img src="<?=base_url()?>encuesta/img/logo.png"/></a></header>
			<div class="body_w">

<?php

$query = $this->db->query("INSERT INTO `motivos` (`id`, `motivo`, `estadoid`) VALUES
(1, 'PENDIENTE PLANTA EXTERNA', 3),
(2, 'PENDIENTE POR SISTEMAS', 3),
(3, 'PENDIENTE VALIDACION REMOTA', 3),
(4, 'PENDIENTE FACILIDADES DEL CLIENTE', 3),
(5, 'PENDIENTE CONTRATISTA', 3),
(6, 'PENDIENTE FACILIDADES INTERNAS', 3),
(7, 'REPROGRAMADO PLANTA EXTERNA', 4),
(8, 'REPROGRAMADO POR SISTEMAS', 4),
(9, 'REPROGRAMADO PENDIENTE MANTTO PEX', 4),
(10, 'REPROGRAMADO PENDIENTE ACTIVAS SISTEMAS', 4),
(11, 'REPROGRAMADO PENDIENTE PROB. MASIVO SISTEMAS', 4),
(12, 'REPROGRAMADO CLIENTE AUSENTE', 4),
(13, 'REPROGRAMADO CLIENTE NO CON EQUIPO', 4),
(14, 'REPROGRAMADO FACILIDADES INTERNAS', 4),
(15, 'REPROGRAMADO POR LA CONTRATISTA', 4),
(16, 'REPROGRAMADO POR FACILIDADES TECNICAS DEL CLIENTE', 4),
(17, 'RECHAZADO POR SISTEMAS', 5),
(18, 'RECHAZADO POR PORTABILIDAD NO EFECTUADA', 5),
(19, 'RECHAZADO POR FALTA DE INFRAESTRUCTURA DE RED', 5),
(20, 'RECHAZADO POR DUPLICIDAD', 5),
(21, 'RECHAZADO POR CLIENTE POSIBLE FRAUDE', 5),
(22, 'RECHAZADO POR NO DEFINE FECHA DE PROGRAMACION', 5),
(23, 'RECHAZADO POR CLIENTE NO DESEA EL SERVICIO', 5),
(24, 'RECHAZADO POR MALA OFERTA', 5),
(25, 'RECHAZADO POR MUDANZA O VIAJE', 5),
(26, 'RECHAZADO POR EXCESO DE ACOMETIDA', 5),
(27, 'RECHAZADO POR FACILIDADES TECNICAS DEL CLIENTE', 5),
(28, 'RECHAZADO POR ZONA PELIGROSA', 5);");

$fields = $this->db->list_fields('motivos');
foreach ($fields as $field)
{
   echo $field . '<br>';
}

?>

				<div class="cont-login">
					<form action="<?=base_url()?>index.php/welcome" method="get">
						<input autofocus class="input_f" name="dni" type="text" value="DNI">
						<input class="btn-active" type="submit" value="INGRESAR">
						<?=(@$error)?'DNI INCORRECTO':''?>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>