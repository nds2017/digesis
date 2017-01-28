			</div>
			<script src="<?=base_url()?>js/departamentos.js"></script>

			<div class="list-mod-panel">
				<h1 style="float: left;">Editar Servicio</h1>
				<h2><a href="<?=base_url()?>index.php/supervisores/lista">Regresar a servicios</a></h2>
			</div>
			<br>

			<?php $data = @$data[0]; ?>
<?php 
			echo form_open_multipart('servicios/edit/' . @$id);			
			?>

			<table class="table table-bordered table-striped">
				<tr>
					<td>Servicio : </td><td><input pattern="[/\s/ÑñA-Za-z]{1,30}" title="Solo Letras" type="text" required maxlength="30" autofocus="autofocus" name="nombres" value="<?=@$data->nombres?>"></td>
				</tr>
				<tr>
				<td>Categoria</td>
				<td>
					<select id="sel_categoria" placeholder="categoria">
					<option>Categoria</option>
					<?php $sel=null;?>
					<?php foreach($categorias as $key=>$row){
					if ($cat==$row->id)
						$sel="selected";
					else
						$sel="";
										 ?>
					<option <?php echo $sel; ?> value="<?php echo trim($row->id) ?>">
					<?php echo trim($row->nombre) ?>
					</option>
										<?php } ?>
					</select>
					</td>
				</tr>
				<tr>
					<td>Motivo : </td><td><input pattern="[/\s/ÑñA-Za-z]{1,30}" title="Solo Letras" type="text" required maxlength="30" name="apellidos" value="<?=@$data->apellidos?>"></td>
				</tr>
				<tr>
					<td>Foto : </td><td><input class="solo-numero" title="Sólo 8 Dígitos" pattern=".{8}" type="number" required name="dni" value="<?=@$data->dni?>"></td>
				</tr>
				
			</table>
			<div class="divbuttons">
				<input class="btnsearch" type="button" value="Regresar a Lista" onclick="window.location='<?=base_url()?>index.php/jefes';">
				<input class="btnsearch" type="submit" value="<?=(@$data? 'Guardar' : 'Crear')?>">
			</div>
		</div>
	</div>
</body>
</html>