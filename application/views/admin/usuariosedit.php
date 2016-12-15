			</div>

<script>
	$(document).ready(function() {
		var publish = $("#publish").val();
		if ( publish == 0 )
			$(".inactivo").show('slow');
		$("#publish").change(function() {
			if ( $("#publish").val() == 0 )
				$(".inactivo").show('slow');
			else
				$(".inactivo").hide('slow');
		});
	});
</script>

			<?php $data = @$data[0]; ?>
			<div class="list-mod-panel">
				<h1>
					<?php if ( @$disabled )
						echo 'Tu Usuario';
						else if ( @$data->id )
							echo 'Editar Usuario';
						else
							echo 'Crear Usuario';
					?>
				</h1>
			</div>

			<?php if ( @$data ) {
				if ( @$disabled )
					echo form_open_multipart('usuarios/edit/' . $data->id . '/true');
				else
					echo form_open_multipart('usuarios/edit/' . $data->id);
			}
			else
				echo form_open_multipart('usuarios/add');
			?>
			<?php if ( @$post ) { ?>
				<p style="color: red"> Cambios Guardados </p><br>
			<?php } ?>

			<table class="table table-bordered table-striped">
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
				<tr>
					<td>Nombre de Usuario : </td><td><input <?=(@$data->id)?'disabled':''?> autofocus="autofocus" type="text" name="user" value="<?=@$data->user?>"></td>
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
					<td>Correo : </td><td><input size="40" type="text" name="email" value="<?=@$data->email?>"></td>
				</tr>
				<?php if ( @$data->id ) { ?>
				<tr>
					<td>Activo : </td>
					<td>
						<select id="publish" <?=(@$disabled?'disabled':'')?> name="publish">
							<option <?=($data->publish)?'selected':''?> value="1">Activo</option>
							<option <?=(!$data->publish)?'selected':''?> value="0">Inactivo</option>
						</select>
						<?php if ( @$disabled ) { ?>
							<input type="hidden" name="publish" value="<?=$data->publish?>"/>
						<?php } ?>
					</td>
				</tr>
				<tr class="inactivo" style="display: none;">
					<td>Fecha de Cese : </td><td><input type="date" name="fecha_cese" value="<?=(@$data->fecha_cese) ? date('Y-m-d', $data->fecha_cese) : date('Y-m-d')?>"></td>
				</tr>
				<tr class="inactivo" style="display: none;">
					<td>Motivo del Cese : </td><td><textarea rows="4" style="width: 50%;" name="motivo_cese"><?=@$data->motivo_cese?></textarea></td>
				</tr>
				<?php } ?>
			</table>
			<div class="divbuttons">
				<input class="btnsearch" type="submit" value="<?=(@$data? 'Guardar' : 'Crear')?>">
			</div>
		</div>
	</div>
</body>
</html>