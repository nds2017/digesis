
<style>
div.upload {
    width: 130px;
    overflow: hidden;
    float: left;
}
</style>
			</div>
			<h1>Cargar Solicitudes</h1><br>
			<fieldset class="search">
				<legend></legend>
				<form method="post" enctype="multipart/form-data">
					<div class="upload">
						<input id="fileSelect" name="file" type="file" accept=".csv" />
					</div>
					&nbsp;&nbsp;&nbsp;<input class="btn" style="margin: 0px;" name="carga" type="submit" value="Cargar" />
					<br><br>
					<?php if ( @$error ) echo $error; ?>
				</form>
			</fieldset>
			<br>
			<fieldset class="search">
				<legend><b>Buscar Por:</b></legend>
				<form method="post">
					N° SOT:
					<input type="text" name="bnombres" value="<?=@$bnombres?>" />
					<input type="submit" name="busqueda" class="btnsearch" value="Filtrar"/>
				</form>
			</fieldset>
			<hr>
			<?php
				if ( !@$error && @$_POST['carga'] )
					echo '<em>' . $info->filas . ' Registros Procesados <br>' . $info->add . ' Registros Agregados <br>' . $info->update . ' Registros Actualizados</em><hr>';
			?>

			<h1>Solicitudes Cargadas <?=date('d-m-Y')?></h1>
			<br>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col"><span>N° SOT</span></th>
						<th scope="col"><span>Tipo Servicio</span></th>
						<th scope="col"><span>Nombre Cliente</span></th>
						<th scope="col"><span>Distrito - Dpto</span></th>
						<th scope="col"><span>Plano</span></th>
					</tr>
				</thead>
				<?php if ( @$data ) { ?>
				<tbody>
				<?php foreach ( $data as $row ) { ?>
				<tr>
					<td><strong><?=$row->id?></strong></td>
					<td><strong><?=$row->tsnombre?></strong></td>
					<td><strong><?=$row->cliente?></strong></td>
					<td><strong><?=$row->distrito . ' - ' . $row->dpto?></strong></td>
					<td><strong><?=$row->plano?></strong></td>
				</tr>
				<?php } ?>
				</tbody>
				<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>