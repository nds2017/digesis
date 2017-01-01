<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Indicaciones</title>
		<link href="<?=base_url()?>encuesta/css/style.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<script src="<?=base_url()?>encuesta/js/jquery-1.9.1.min.js"></script>
		<script src="<?=base_url()?>encuesta/js/jquery-ui.js"></script>
		<script src="<?=base_url()?>encuesta/js/ui-front.js" type="text/javascript"></script>
	</head>

<body>
	<div class="wrapper">
		<header>
			 <img src="<?=base_url()?>encuesta/img/logo.png"/>
		</header>
		<div class="body_w">
			<div class="indications">
				<table class="detalle-billetera">
					<thead>
						<tr>
							<th>Fecha</th>
							<th>Cant.SOT</th>
							<th>Monto SOT</th>
							<th>Desc.Asist</th>
							<th>Desc.RF</th>
							<th>Monto</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					foreach($detalle as $key=>$value):
					?>
					<tr>
						<td data-label="Fecha"><?php echo $value['fecha']; ?></td>
						<td data-label="Cant.SOT"><?php echo $value['sot']; ?></td>
						<td data-label="Monto SOT"><?php echo $value['monto'] ?></td>
						<td data-label="Desc.Asist"><?php echo $value['desc_asistencia'] ?></td>
						<td data-label="Desc.RF"><?php echo $value['desc_rf'] ?></td>
						<td data-label="Monto"><?php echo $value['total'] ?></td>
					</tr>
					<?php 
						endforeach;
					?>	
					</tbody>					  
				</table>

				<div class="cont-btn">
					<?php $url = base_url() . 'index.php/encuestas/?dni=' . $_GET['dni']; ?>
					<input type="button" value="CERRAR" onclick="window.location='<?php echo $url?>';">
				</div>
			</div>
		</div>
	</div>

</body>
</html>
