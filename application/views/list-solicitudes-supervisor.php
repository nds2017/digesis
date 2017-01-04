<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Lista de Solicitudes Supervisor</title>
		
		<link href="<?=base_url()?>encuesta/css/style.css?v=11" rel="stylesheet" type="text/css">

		<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
		

		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
				
		<script src="<?=base_url()?>encuesta/js/jquery-1.9.1.min.js"></script>
		<script src="<?=base_url()?>encuesta/js/jquery-ui.js"></script>
		<script src="<?=base_url()?>encuesta/js/ui-front.js" type="text/javascript"></script>

    
<script type="text/javascript">

$(function() {
            $( "#fecha" ).datepicker();
         });
	
</script>
	</head>

	<body>	
	
	<div class="wrapper">
		<a href="<?=base_url()?>index.php/encuestas/supervisores?dni=<?=$_GET['dni']?>">
			<header>
			<div class="cont_logo">
				<img src="<?=base_url()?>encuesta/img/logo.png"/>
			</div>
			<div class="cont_billetera">
				<a  href="#" class="billetera">Monedero Digital</a>
				<div style="width: 200px;float: left;"> 
				<input type="text" class="form-control" id="fecha" name="fecha" placeholder="Fecha" value="<?php echo $fecha?>" style="float:right;  width: 12%">
				</div>
			</div>	
			<div style="clear: both;"></div>
			</header>
		</a>
		<div class="body_w">
			<div class="list-solicitud">
				<div class="cont_time-s">
					<h4>Fecha: <?=date('d/m/Y')?></h4>
					<h4><em>Bienvenido <?=@$nom_supervisor?></em><br>
					<a href="<?=base_url()?>">Cerrar Sesión</a></h4>
				</div>
				<div class="estados">
					<div class="total_e">
						Total Programados: <?php echo $acumulador['nuevos'] + $acumulador['reprogramados'] + $acumulador['atendidos'] + $acumulador['pendientes'] + $acumulador['rechazados']						
						?>
					</div>
					<div class="cont_e">
						<div class="cont-1">
							<h4>
								Validado
							</h4>
							<h3>
								<?=$acumulador['atendidos']?>
							</h3>
						</div>
						<div class="cont-1 cont2">
							<h4>
								Pendiente de Validar
							</h4>
							<h3>
								<?=$acumulador['pendientes']?>
							</h3>
						</div>
					</div>
					<div class="cont_e">
						<div class="cont-1 cont3">
							<h4>
								Reprogramado
							</h4>
							<h3>
								<?=$acumulador['reprogramados']?>
							</h3>
						</div>
						<div class="cont-1 cont4">
							<h4>
							   Rechazado
							</h4>
							<h3>
								<?=$acumulador['rechazados']?>
							</h3>
						</div>
					</div>
				</div>
				<div class="container-list" id="tab-ui">
				<!--
					<ul class="ui-tabs-links tab-links">
						<li class="active">
							<a href="#" class="check">
								<span></span>	
							</a>
						</li>
					
						<li>
							<a href="#"  class="alert">
								<span>(<?=count($pendientes)?>)</span> 
							</a>
						</li>
						<li>
							<a href="#"  class="photo">
								<span>(<?=count($sinfotos)?>)</span>
							</a>
						</li>                        
						
					</ul>
					-->
					<div class="wrap-ui-container-tab">
						<div class="tab-content-group ui-container-tab">
							<div class="ui-tab-item active tab-content">
								<div class="tab-title">RESUMEN POR TECNICO</div>
		           

				<table class="detalle-billetera">
					<thead>
						<tr>		
							<th>Tecnico</th>
							<th>SOT Atendidos</th>
							<th>SOT pendientes</th>		
							<th>SOT reprogramados</th>	  <th>SOT rechazados</th>	
						</tr>
					</thead>
					<tbody>
	<?php 					
	foreach($supervisor as $key=>$value):
	?>
	<tr>	
	<td data-label="Tecnico">
	<?php echo $value['tecnico']; ?></td>
	<td data-label="SOT Atendidos">
	<?php echo count($value['atendidos']) ?></td>
	<td data-label="SOT pendientes">
	<?php echo count($value['pendientes']) ?></td>

	<td data-label="SOT reprogramados"><?php echo count($value['reprogramados']) ?></td>
	<td data-label="SOT rechazados"><?php echo count($value['rechazados']) ?></td>
						
	</tr>
	<?php 
		endforeach;
	?>	
					</tbody>					  
				</table>


																
							</div>
													
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
