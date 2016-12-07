			</div>

			<div class="list-mod-panel">
				<h1 style="float: left;">Asignar Técnico&nbsp;&nbsp;</h1>
				<h2><a href="<?=base_url()?>index.php/solicitudes/listatecnicos">Regresar a Asignar Técnicos</a></h2>
			</div>
			<br>

			<?php
				echo form_open_multipart('solicitudes/edittecnicos/' . @$data->id);
			?>

			<table class="table table-bordered table-striped">
				<tr>
					<td>N° Solicitud : </td><td><input disabled type="text" name="solicitudid" value="<?=@$data->id?>"></td>
				</tr>
				<tr>
					<td>Fecha de Programación : </td><td><input disabled type="date" name="fecha_instalacion" value="<?=(@$data->fecha_instalacion) ? date('Y-m-d', $data->fecha_instalacion) : null?>"></td>
				</tr>
			</table>
			<fieldset class="fieldform">
				<legend><b>Personal</b></legend>
				<table class="table table-bordered table-striped">
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
				<input class="btnsearch" type="button" value="Regresar a Lista" onclick="window.location='<?=base_url()?>index.php/solicitudes/listatecnicos';">
				<input class="btnsearch" type="submit" value="<?=(@$data? 'Guardar' : 'Crear')?>">
			</div>
		</div>
	</div>
</body>
</html>