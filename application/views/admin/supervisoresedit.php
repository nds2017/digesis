			</div>

			<div class="list-mod-panel">
				<h1 style="float: left;"> Crear Supervisor &nbsp;&nbsp;</h1>
				<h2><a href="<?=base_url()?>index.php/supervisores/lista">Regresar a Supervisores</a></h2>
			</div>
			<br>

			<?php $data = @$data[0]; ?>
			<?php if ( @$data )
				echo form_open_multipart('supervisores/edit/' . @$data->id);
			else
				echo form_open_multipart('supervisores/add');
			?>

			<table class="table table-bordered table-striped">
				<tr>
					<td>Nombres : </td><td><input type="text" name="nombres" value="<?=@$data->nombres?>"></td>
				</tr>
				<tr>
					<td>Apellidos : </td><td><input type="text" name="apellidos" value="<?=@$data->apellidos?>"></td>
				</tr>
				<tr>
					<td>DNI : </td><td><input type="text" maxlength="8" name="dni" value="<?=@$data->dni?>"></td>
				</tr>
				<tr>
					<td>Correo : </td><td><input type="text" name="email" value="<?=@$data->email?>"></td>
				</tr>
				<tr>
					<td>Jefe : </td>
					<td>
						<select name="jefeid">
							<?php foreach ( $jefes as $key => $jefe ) { ?>
								<option <?=(@$data->jefeid==$jefe->id ? 'selected' : '')?>  value="<?=$jefe->id?>"><?=$jefe->nombres?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Base : </td>
					<td>
						<select name="baseid">
							<?php foreach ( $bases as $key => $base ) { ?>
								<option <?=(@$data->baseid==$base->id ? 'selected' : '')?>  value="<?=$base->id?>"><?=$base->nombre?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Usuario : </td><td><input type="text" name="user" value="<?=@$data->user?>"></td>
				</tr>
				<tr>
					<td>Contraseña : </td><td><input type="password" name="password" value="<?=@$data->password?>"></td>
				</tr>
				<?php if ( @$data->id ) { ?>
					<tr><td>Activo : </td>
						<td>
							<select name="publish">
								<option <?=($data->publish)?'selected':''?> value="1">Activo</option>
								<option <?=(!$data->publish)?'selected':''?> value="0">Inactivo</option>
							</select>
						</td>
					</tr>
				<?php } ?>
			</table>
			<div class="divbuttons">
				<input class="btnsearch" type="button" value="Regresar a Lista" onclick="window.location='<?=base_url()?>index.php/supervisores';">
				<input class="btnsearch" type="submit" value="<?=(@$data? 'Guardar' : 'Crear')?>">
			</div>
		</div>
	</div>
</body>
</html>