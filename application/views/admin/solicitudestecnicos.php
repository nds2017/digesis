			</div>
			<script src="<?=base_url()?>js/departamentos.js"></script>

			<h1> Soporte de Servicio</h1><br>
			<fieldset class="search">
				<legend></legend>
				<form id="form" method="post" action="<?=base_url()?>index.php/solicitudes/listatecnicos">
					<nav class="top_menu">
						<ul>
							<li class="active"><a href="<?=base_url()?>index.php/solicitudes/listatecnicos">Pendiente de Asignar (<?=count($data['programadas']) + count($data['pendientes'])?>)&nbsp;&nbsp;|</a></li>
							<li><a href="<?=base_url()?>index.php/solicitudes/seguimiento">Seguimiento&nbsp;&nbsp;|</a></li>
							<li><a href="<?=base_url()?>index.php/solicitudes/listavalidados">Incidencias&nbsp;&nbsp;|</a></li>
						</ul>
					</nav>

					<input type="hidden" id="url" value="<?=base_url()?>index.php/solicitudes"/>
					Departamento :
					<select id="dptoid">
						<option value="0">-Seleccione-</option>
						<?php foreach ($departamentos as $id => $departamento) { ?>
						<option <?=(@$departamentoid==$id ? 'selected' : '')?> value=<?=$id?>><?=$departamento?></option>
						<?php } ?>
					</select>
					Provincia
					<select id="provinciaid" name="provinciaid">
						<?php if ( @$distritoid ) { ?>
						<?php foreach ($provincias as $id => $provincia) { ?>
						<option <?=(@$provinciaid==$id ? 'selected' : '')?> value=<?=$id?>><?=$provincia?></option>
						<?php } ?>
						<?php } ?>
					</select>
					Distrito:
					<select name="distritoid" id="distritoid">
						<?php if ( @$distritoid ) { ?>
						<?php foreach ($distritos as $id => $distrito) { ?>
						<option <?=(@$distritoid==$id ? 'selected' : '')?> value=<?=$id?>><?=$distrito?></option>
						<?php } ?>
						<?php } ?>
					</select>
					<input type="submit" class="btnsearch" value="Filtrar"/>
					<br>
					N° SOT: <input type="text" size="10" name="solicitudid" value="<?=@$solicitudid?>"/>
					<input type="submit" class="btnsearch" value="Buscar"/>
					
					
		<div >
		 <input type="button" id="mult-asignacion" class="btnsearch" value="Asignar a:"/>						
		</div> 
				</form>
			</fieldset>
			<div style="width:100%" id="content">

			
			<div id="central">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
				<th scope="col"><span>Sel</span></th>
						<th scope="col"><span>N° SOT</span></th>
						<th scope="col"><span>TIPO DE SERVICIO</span></th>
						<th scope="col"><span>NOMBRE DEL CLIENTE</span></th>
						<th scope="col"><span>DISTRITO - DPTO</span></th>
						<th scope="col"><span>FECHA PROGRAMACIÓN</span></th>
						<th scope="col"><span>ASIGNAR</span></th>
					</tr>
				</thead>
				<?php if ( count($data['pendientes']) || count($data['programadas']) ) { ?>
				<tbody>
				<?php if ( count($data['programadas']) ) { ?>
				<?php foreach ( $data['programadas'] as $row ) { ?>
				<tr style="color: green;">
					<td><strong><?=$row->id?></strong></td>
					<td><strong><?=$row->tsnombre?></strong></td>
					<td><strong><?=$row->cliente?></strong></td>
					<td><strong><?=$row->distrito . ' - ' . $row->dpto?></strong></td>
					<td><strong><?=date('d-m-Y', $row->fecha_instalacion)?></strong></td>
					<td><a title="Asignar Técnico" href="<?=base_url()?>index.php/solicitudes/formtecnicos/<?=$row->id?>"><img src="<?=base_url()?>img/editar.png"></a></td>
				</tr>
				<?php } ?>
				<?php } ?>

				<?php if ( count($data['pendientes']) ) { ?>
				<?php foreach ( $data['pendientes'] as $row ) { ?>
				<tr>

				<td><strong>
	<input type="checkbox" name="sot[]" value="<?=$row->id?>">
					</strong></td>
					
					<td><strong><?=$row->id?></strong></td>
					<td><strong><?=$row->tsnombre?></strong></td>
					<td><strong><?=$row->cliente?></strong></td>
					<td><strong><?=$row->distrito . ' - ' . $row->dpto?></strong></td>
					<td><strong><?=date('d-m-Y', $row->fecha_instalacion)?></strong></td>
					<td><a title="Asignar Técnico" href="<?=base_url()?>index.php/solicitudes/formtecnicos/<?=$row->id?>"><img src="<?=base_url()?>img/editar.png"></a></td>
				</tr>
				<?php } ?>
				<?php } ?>
				</tbody>
				<?php } else { ?>
				</table>
				
				<h2 style="color: blue"> SOLICITUD NO ENCONTRADA </h2>
				<?php } ?>
			</table>
		</div>
		<div >
		 <input type="button" id="mult-asignacion" class="btnsearch" value="Asignar a:"/>						
		</div> 
		</div>
	</div>
</body>
</html>