			</div>

			<div class="list-mod-panel">
				<h1 style="float: left;"> Crear Jefe &nbsp;&nbsp;</h1>
				<h2><a href="<?=base_url()?>index.php/supervisores/lista">Regresar a Jefes</a></h2>
			</div>
			<br>

			<?php $data = @$data[0]; ?>
			<?php if ( @$data )
				echo form_open_multipart('jefes/edit/' . @$data->id);
			else
				echo form_open_multipart('jefes/add');
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
					<td>Region : </td>
					<td>
						<select name="regionid">
							<?php foreach ( $regiones as $key => $region ) { ?>
								<option <?=(@$data->regionid==$key ? 'selected' : '')?>  value="<?=$key?>"><?=$region?></option>
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
				<input class="btnsearch" type="button" value="Regresar a Lista" onclick="window.location='<?=base_url()?>index.php/jefes';">
				<input class="btnsearch" type="submit" value="<?=(@$data? 'Guardar' : 'Crear')?>">
			</div>
		</div>
	</div>
</body>
</html>