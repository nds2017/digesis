<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Lista de Solicitudes</title>
		<link href="<?=base_url()?>encuesta/css/style.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url()?>encuesta/css/jquery-ui.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<script src="<?=base_url()?>encuesta/js/jquery-1.9.1.min.js"></script>
		<script src="<?=base_url()?>encuesta/js/jquery-ui.js"></script>
		<script src="<?=base_url()?>encuesta/js/ui-front.js" type="text/javascript"></script>
	</head>

	<body>
		<div class="ui-popup-options">
			<a href="#" class="ui-popup-close"></a>
			<div class="ui-popup-options-wrapper schedule">
				<input type="hidden" id="schedule-sid" name="schedule-sid" value="empty-sid">
				<div class="calendar">
					<div class="calendar-box"><div id="datepicker1"></div></div>
				</div>
				<div class="ui-popup-options-contenido">
					<div class="datetime ui-popup-options-contenido">
						<div class="ui-popup-options-titulo"><span class="icon-titulo" href="#">SELECCIONAR</span></div>
						<ul class="ui-popup-options-list">
							<li>
								<a class="icon-cerrar" href="#">Mañana</a>
							</li>
							<li>
								<a class="icon-cerrar" href="#">Tarde</a>
							</li>
						</ul>
					</div>

					<div class="reason">
						<div class="ui-popup-options-titulo"><span class="icon-titulo" href="#">MOTIVO REPROGRAMACION</span></div>
						<ul class="ui-popup-options-list">
							<li>
								<a class="icon-cerrar" href="#">PLANTA EXTERNA</a>
							</li>
							<li>
								<a class="icon-cerrar" href="#">POR SISTEMAS</a>
							</li>
							<li>
								<a class="icon-cerrar" href="#">PENDIENTE MANTTO PEX</a>
							</li>
							<li>
								<a class="icon-cerrar" href="#">PENDIENTE ACTIVAS SISTEMAS</a>
							</li>
							<li>
								<a class="icon-cerrar" href="#">PENDIENTE PROB. MASIVO SISTEMAS</a>
							</li>
							<li>
								<a class="icon-cerrar" href="#">CLIENTE AUSENTE</a>
							</li>
							<li>
								<a class="icon-cerrar" href="#">CLIENTE NO CON EQUIPO</a>
							</li>
							<li>
								<a class="icon-cerrar" href="#">POR LA CONTRATISTA</a>
							</li>
							<li>
								<a class="icon-cerrar" href="#">POR FACILIDADES TECNICAS DEL CLIENTE3</a>
							</li>
						</ul>
					</div>
					<div class="cont-btn final-p">
						<input type="button" value="GUARDAR">
						<input class="cancel" type="button" value="CANCELAR">
					</div>
				</div>
			</div>
			<div class="ui-popup-options-wrapper client">
				<div class="ui-popup-options-contenido">
					<input type="hidden" id="client-sid" name="client-sid" value="empty-sid">
					<div class="ui-popup-options-titulo"><span class="icon-titulo" href="#">SELECCIONAR</span></div>
					<ul class="ui-popup-options-list">
						<li>
							<a class="icon-cerrar" href="#"> PLANTA EXTERNA</a>
						</li>
						<li>
							<a class="icon-cerrar" href="#"> POR SISTEMAS</a>
						</li>
						 <li>
							<a class="icon-cerrar" href="#">VALIDACION REMOTA</a>
						</li>
						<li>
							<a class="icon-cerrar" href="#">FACILIDADES DEL CLIENTE</a>
						</li>
						<li>
							<a class="icon-cerrar" href="#"> CONTRATISTA</a>
						</li>
						<li>
							<a class="icon-cerrar" href="#"> FACILIDADES INTERNAS2</a>
						</li>
					</ul>
					<div class="cont-btn final-p">
						<input type="button" value="GUARDAR">
						<input class="cancel" type="button" value="CANCELAR">
					</div>
				</div>
			</div>
		<div class="ui-popup-options-wrapper test">
			<input type="hidden" id="test-sid" name="test-sid" value="empty-sid">
			<div class="ui-popup-options-contenido">
				<div class="ui-popup-options-titulo"><span class="icon-titulo" href="#">SELECCIONAR</span></div>
				<ul class="ui-popup-options-list">
					<li>
						<a class="icon-encuestar" href="preguntas-final.html">Iniciar Encuesta</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">Denegar Encuesta</a>
					</li>
				</ul>
				<div class="cont-btn final-p">
					<input type="button" value="GUARDAR">
					<input class="cancel" type="button" value="CANCELAR">
				</div>
			</div>
		</div>
		<div class="ui-popup-options-wrapper reject">
			<input type="hidden" id="reject-sid" name="reject-sid" value="empty-sid">
			<div class="ui-popup-options-contenido">
				<div class="ui-popup-options-titulo"><span class="icon-titulo" href="#">MOTIVO RECHAZO</span></div>
				<ul class="ui-popup-options-list">
					<li>
						<a class="icon-cerrar" href="#">PORTABILIDAD NO EFECTUADA</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">FALTA DE INFRAESTRUCTURA DE RED</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">DUPLICIDAD</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">NO DEFINE FECHA DE PROGRAMACION</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">CLIENTE NO DESEA EL SERVICIO</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">MALA OFERTA</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">MUDANZA O VIAJE</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">EXCESO DE ACOMETIDA</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">FACILIDADES TECNICAS DEL CLIENTE</a>
					</li>
					<li>
						<a class="icon-cerrar" href="#">ZONA PELIGROSA</a>
					</li>
				</ul>
			</div>
			<div class="cont-btn final-p">
				<input type="button" value="GUARDAR">
				<input class="cancel" type="button" value="CANCELAR">
			</div>
		</div>
	</div>
	<div class="wrapper">
		<header>
			 <img src="<?=base_url()?>encuesta/img/logo.png"/>
		</header>
		<div class="body_w">
			<div class="list-solicitud">
				<div class="cont_time-s">
					<h4>Fecha: <?=date('d/m/Y')?></h4>
					<h4><a style="color: white;" href="<?=base_url()?>">Cerrar Sesión</a></h4>
				</div>
				<div class="estados">
					<div class="total_e">
						Total Programado: <?=count($nuevos) + count($reprogramados) + count($atendidos) + count($pendientes) + count($rechazados) ?>
					</div>
					<div class="cont_e">
						<div class="cont-1">
							<h4>
								Validado
							</h4>
							<h3>
								<?=count($atendidos)?>
							</h3>
						</div>
						<div class="cont-1 cont2">
							<h4>
								Pendiente de Validar
							</h4>
							<h3>
								<?=count($pendientes)?>
							</h3>
						</div>
					</div>
					<div class="cont_e">
						<div class="cont-1 cont3">
							<h4>
								Reprogramado
							</h4>
							<h3>
								<?=count($reprogramados)?>
							</h3>
						</div>
						<div class="cont-1 cont4">
							<h4>
							   Rechazado
							</h4>
							<h3>
								<?=count($rechazados)?>
							</h3>
						</div>
					</div>
				</div>
				<div class="container-list" id="tab-ui">
					<ul class="ui-tabs-links tab-links">
						<li class="active">
							<a href="#" class="check">
								<span>(<?=count($nuevos)?>)</span>	
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
					<div class="wrap-ui-container-tab">
						<div class="tab-content-group ui-container-tab">
							<div class="ui-tab-item active tab-content">
								<div class="tab-title">BANDEJA DE ENTRADA</div>
								<?php if ( count($reprogramados) ) { ?>
								<?php foreach ( $reprogramados as $key => $reprogramado ) { ?>
								<div class="cont-solicitud active tservicio" data-codigo="<?=$reprogramado->id?>">
									<div class="data1 t1">TIPO DE SERVICIO</div>
									<div class="data2"><?=$reprogramado->tsnombre?></div>
									<div class="data1">CÓDIGO SOT</div>
									<div class="data2"><?=$reprogramado->id?></div>
									<div class="data1">CLIENTE</div>
									<div class="data2"><?=$reprogramado->cliente?></div>
									<div class="data1">ESTADO</div>
									<div class="data2 combo step1 combo-ui">
										<select name="">
											<option value="Seleccionar">Seleccionar</option>
											<option value="Validado">Validado</option>
											<option value="Pendiente">Pendiente</option>
											<option selected value="Reprogramado">Reprogramado</option>
											<option value="Rechazado">Rechazado</option>
										</select>
									</div>
									<div class="data1 label display-none combo-ui-lnk">
										MOTIVO RECHAZO
									</div>
									<div class="data2 combo display-none combo-ui-lnk">
										<select name="">
											<option value="MOTIVO 1">MOTIVO 1</option>
											<option value="MOTIVO 1">MOTIVO 2</option>
											<option value="MOTIVO 1">MOTIVO 3</option>
											<option value="MOTIVO 1">MOTIVO 4</option>
											<option value="MOTIVO 1">MOTIVO 5</option>
										</select>
									</div>
									<div class="reason cont-btn btn-inactive display-none combo-ui-lnk">
										<input type="button" value="GUARDAR MOTIVO">
									</div>
									<div class="poll cont-btn display-none combo-ui-lnk">
										<input type="button" value="ENCUESTA">
									</div>
								</div>
								<?php } ?>
								<?php } ?>

								<?php if ( count($nuevos) ) { ?>
								<?php foreach ( $nuevos as $key => $nuevo ) { ?>
								<div class="cont-solicitud" data-codigo="<?=$nuevo->id?>">
									<div class="data1">TIPO DE SERVICIO</div>
									<div class="data2"><?=$nuevo->tsnombre?></div>
									<div class="data1">CÓDIGO SOT</div>
									<div class="data2"><?=$nuevo->id?></div>
									<div class="data1">CLIENTE</div>
									<div class="data2"><?=$nuevo->cliente?></div>
									<div class="data1">ESTADO</div>
									<div class="data2 combo step1 combo-ui">
										<select name="">
											<option value="Seleccionar">Seleccionar</option>
											<option value="Validado">Validado</option>
											<option value="Pendiente">Pendiente</option>
											<option value="Reprogramado">Reprogramado</option>
											<option value="Rechazado">Rechazado</option>
										</select>
									</div>
									<div class="data1 label display-none combo-ui-lnk">
										MOTIVO RECHAZO
									</div>
									<div class="data2 combo display-none combo-ui-lnk">
										<select name="">
											<option value="MOTIVO 1">MOTIVO 1</option>
											<option value="MOTIVO 1">MOTIVO 2</option>
											<option value="MOTIVO 1">MOTIVO 3</option>
											<option value="MOTIVO 1">MOTIVO 4</option>
											<option value="MOTIVO 1">MOTIVO 5</option>
										</select>
									</div>
									<div class="reason cont-btn btn-inactive display-none combo-ui-lnk">
										<input type="button" value="GUARDAR MOTIVO">
									</div>
									<div class="poll cont-btn display-none combo-ui-lnk">
										<input type="button" value="ENCUESTA">
									</div>
								</div>
								<?php } ?>
								<?php } ?>
							</div>
							<div class="ui-tab-item tab-content">
								<div class="tab-title">PENDIENTE VALIDAR</div>
								<?php if ( count($pendientes) ) { ?>
								<?php foreach ( $pendientes as $key => $pendiente ) { ?>
								<div class="cont-solicitud" data-codigo="<?=$pendiente->id?>">
									<div class="data1">CÓDIGO SOT</div>
									<div class="data2"><?=$pendiente->id?></div>
									<div class="data1">MOTIVO</div>
									<div class="data2"><?='Motivo X'?></div>
									<div class="data1">CLIENTE</div>
									<div class="data2"><?=$pendiente->cliente?></div>
									<div class="data1">DIRECCIÓN</div>
									<div class="data2"><?=$pendiente->direccion?></div>
									<div class="data1">ESTADO</div>
									<div class="data2 combo step1 combo-ui">
										<select name="">
											<option value="Pendiente">Pendiente</option>
											<option value="Validado">Validado</option>
											<option value="Rechazado">Rechazado</option>
										</select>
									</div>
									<div class="data1 label display-none combo-ui-lnk">
										MOTIVO RECHAZO
									</div>
									<div class="data2 combo display-none combo-ui-lnk">
										<select name="">
											<option value="MOTIVO 1">MOTIVO 1</option>
											<option value="MOTIVO 1">MOTIVO 2</option>
											<option value="MOTIVO 1">MOTIVO 3</option>
											<option value="MOTIVO 1">MOTIVO 4</option>
											<option value="MOTIVO 1">MOTIVO 5</option>
										</select>
									</div>
									<div class="reason cont-btn btn-inactive display-none combo-ui-lnk">
										<input type="button" value="GUARDAR MOTIVO">
									</div>
									<div class="poll cont-btn display-none combo-ui-lnk">
										<input type="button" value="ENCUESTA">
									</div>
								</div>
								<?php } ?>
								<?php } ?>                          
							</div>
							<div class="ui-tab-item tab-content">
								<div class="tab-title">RF PENDIENTES</div>
								<?php if ( count($sinfotos) ) { ?>
								<?php foreach ( $sinfotos as $key => $sinfoto ) { ?>
								<div class="cont-solicitud">
									<div class="data1">Nro. SOT</div>
									<div class="data2"><?=$sinfoto->id?></div>
									<div class="data1">ESTADO DE FOTO</div>
									<div class="data2"><?=$sinfoto->rfnombre?></div>
									<div class="data1">TITULAR</div>
									<div class="data2"><?=$sinfoto->cliente?></div>
									<div class="data1"> DIRECCION</div>
									<div class="data2"><?=$sinfoto->direccion?></div>
									<div class="data1">PLANO</div>
									<div class="data2"><?=$sinfoto->plano?></div>
									<div class="data1">ESTADO</div>
									<div class="data2 combo step1 combo-ui">                                             
										<select disabled>
											<option value="Atendido">Atendido</option>
										</select>
									</div>
								</div>
								<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
