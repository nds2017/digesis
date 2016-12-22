			</div>
			<script src="<?=base_url()?>js/departamentos.js"></script>
			<div class="list-mod-panel">
				<h1 style="float: left;"> <?=(@$data)?'Editar Solicitud' : 'Agregar Solicitud'?> &nbsp;&nbsp;</h1>
				<h2><a href="<?=base_url()?>index.php/solicitudes/lista">Regresar a Lista de Solicitudes</a></h2>
			</div>
			<br>

			<?php
			if ( @$data )
				echo form_open_multipart('solicitudes/edit/' . @$data->id);
			else
				echo form_open_multipart('solicitudes/add');
			?>

			<table class="table table-bordered table-striped">
				<input type="hidden" id="url" value="<?=base_url()?>index.php/solicitudes"/>
				<tr>
					<td>N° Solicitud : </td><td><input required maxlength="11" type="text" autofocus="autofocus" name="solicitudid" value="<?=@$data->id?>"></td>
				</tr>
				<tr>
					<td>Fecha de Programación : </td><td><input type="date" name="fecha_instalacion" value="<?=(@$data->fecha_instalacion) ? date('Y-m-d', $data->fecha_instalacion) : null?>"></td>
				</tr>
				<tr>
					<td>Tipo de Trabajo : </td>
					<td>
						<select name="tipotrabajoid">
							<?php foreach ( $tipotrabajos as $key => $tipotrabajo ) { ?>
								<option <?=(@$data->tipotrabajoid==$key ? 'selected' : '')?>  value="<?=$key?>"><?=$tipotrabajo?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Tipo de Servicio : </td>
					<td>
						<select name="tiposervicioid">
							<?php foreach ( $tiposervicios as $key => $tiposervicio ) { ?>
								<option <?=(@$data->tiposervicioid==$key ? 'selected' : '')?>  value="<?=$key?>"><?=$tiposervicio?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Plano : </td><td><input maxlength="20" type="text" name="plano" value="<?=@$data->plano?>"></td>
				</tr>
				<?php if ( @$data->id ) { ?>
				<tr>
					<td>Estado : </td>
					<td>
						<select id="estadoid" name="estadoid">
							<?php foreach ( $estados as $key => $estado ) { ?>
								<option <?=(@$data->estadoid==$key ? 'selected' : '')?>  value="<?=$key?>"><?=$estado?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Motivo : </td>
					<td>
						<select id="motivoid" name="motivoid">
							<option value="0">-Seleccione-</option>
							<?php foreach ( $motivos as $key => $motivo ) { ?>
								<option <?=(@$data->motivoid==$key ? 'selected' : '')?>  value="<?=$key?>"><?=$motivo?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<?php } ?>
				</table>
				<fieldset class="fieldform">
					<legend><b>Cliente</b></legend>
					<table class="table table-bordered table-striped">
						<tr>
							<td>Nombres : </td><td><input pattern="[/\s/A-Za-z]{1,30}" maxlength="30" required type="text" size="30" name="cliente" value="<?=@$data->cliente?>"></td>
						</tr>
						<tr>
							<td>Direccion : </td><td><input required maxlength="100" type="text" size="70" name="direccion" value="<?=@$data->direccion?>"></td>
						</tr>
						<tr>
							<td>Region : </td>
							<td>
								<select name="regionid">
									<option value="0">-Seleccione-</option>
									<?php foreach ($regiones as $id => $region) { ?>
									<option <?=(@$data->regionid==$id ? 'selected' : '')?> value=<?=$id?>><?=$region?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Departamento : </td>
							<td>
								<select id="dptoid">
									<option value="0">-Seleccione-</option>
									<?php foreach ($departamentos as $id => $departamento) { ?>
									<option <?=(@$data->departamentoid==$id ? 'selected' : '')?> value=<?=$id?>><?=$departamento?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Provincia : </td>
							<td>
								<select id="provinciaid">
									<?php if ( @$data->distritoid ) { ?>
									<?php foreach ($provincias as $id => $provincia) { ?>
									<option <?=(@$data->provinciaid==$id ? 'selected' : '')?> value=<?=$id?>><?=$provincia?></option>
									<?php } ?>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Distrito : </td>
							<td>
								<select name="distritoid" id="distritoid">
									<?php if ( @$data->distritoid ) { ?>
									<?php foreach ($distritos as $id => $distrito) { ?>
									<option <?=(@$data->distritoid==$id ? 'selected' : '')?> value=<?=$id?>><?=$distrito?></option>
									<?php } ?>
									<?php } ?>
								</select>
							</td>
						</tr>
					</table>
				</fieldset>
				<br>
				<fieldset class="fieldform">
					<legend><b>Personal</b></legend>
					<table class="table table-bordered table-striped">
						<tr>
							<td>Analista de Servicio: </td>
							<td>
								<select name="analistaid">
									<option value="0">-Seleccione-</option>
									<?php foreach ( $analistas as $key => $analista ) { ?>
									<option <?=(@$data->aid==$analista->id ? 'selected' : '')?>  value="<?=$analista->id?>"><?=$analista->nombres . ' ' . $analista->apellidos?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Técnico 1: : </td>
							<td>
								<select name="tecnico1id">
									<option value="0">-Seleccione-</option>
									<?php foreach ( $tecnicos1 as $key => $tecnico1 ) { ?>
									<option <?=(@$data->t1id==$key ? 'selected' : '')?>  value="<?=$key?>"><?=$tecnico1?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Técnico 2: : </td>
							<td>
								<select name="tecnico2id">
									<option value="0">-Seleccione-</option>
									<?php foreach ( $tecnicos2 as $key => $tecnico2 ) { ?>
									<option <?=(@$data->t2id==$key ? 'selected' : '')?>  value="<?=$key?>"><?=$tecnico2?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
					</table>
				</fieldset>
				<br><br>
				<div class="divbuttons">
					<input class="btnsearch" type="button" value="Regresar a Lista" onclick="window.location='<?=base_url()?>index.php/solicitudes/lista';">
					<input <?=(@$admin)?'':'disabled'?> class="btnsearch" type="submit" value="<?=(@$data? 'Guardar' : 'Crear')?>">
				</div>
		</div>
	</div>
</body>
</html>