			</div>

			<div class="list-mod-panel">
				<h1 style="float: left;"> Crear Usuario &nbsp;&nbsp;</h1>
				<h2><a href="<?=base_url()?>index.php/usuarios/lista">Regresar a Lista de Usuarios</a></h2>
			</div>
			<br>

			<?php $data = @$data[0]; ?>
			<?php if ( @$data ) {
				if ( @$disabled )
					echo form_open_multipart('usuarios/edit/' . $data->id . '/true');
				else
					echo form_open_multipart('usuarios/edit/' . $data->id);
			}
			else
				echo form_open_multipart('usuarios/add');
			?>

			<table class="table table-bordered table-striped">
				<tr>
					<td>Nombre de Usuario : </td><td><input <?=(@$data->id)?'disabled':''?> type="text" name="user" value="<?=@$data->user?>"></td>
				</tr>
				<tr>
					<td>Contraseña : </td><td><input type="password" name="password" value="<?=@$data->password?>"></td>
				</tr>
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
					<td>Rol : </td>
					<td>
						<select <?=(@$disabled?'disabled':'')?> name="rolid">
							<?php foreach ( $roles as $key => $rol ) { ?>
								<option <?=(@$data->rolid==$rol->id ? 'selected' : '')?>  value="<?=$rol->id?>"><?=$rol->nombre?></option>
							<?php } ?>
						</select>
						<?php if ( @$disabled ) { ?>
							<input type="hidden" name="rolid" value="<?=$data->rolid?>"/>
						<?php } ?>
					</td>
				</tr>
				<?php if ( @$data->id ) { ?>
					<tr><td>Activo : </td>
						<td>
							<select <?=(@$disabled?'disabled':'')?> name="publish">
								<option <?=($data->publish)?'selected':''?> value="1">Activo</option>
								<option <?=(!$data->publish)?'selected':''?> value="0">Inactivo</option>
							</select>
							<?php if ( @$disabled ) { ?>
								<input type="hidden" name="publish" value="<?=$data->publish?>"/>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</table>
			<div class="divbuttons">
				<input class="btnsearch" type="button" value="Regresar a Lista" onclick="window.location='<?=base_url()?>index.php/usuarios';">
				<input class="btnsearch" type="submit" value="<?=(@$data? 'Guardar' : 'Crear')?>">
			</div>
		</div>
	</div>
</body>
</html>