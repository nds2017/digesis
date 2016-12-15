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

			<h1>Solicitudes Cargadas Desde <?=date('d-m-Y')?></h1>
			<?php
				//$this->db->query("DELETE FROM supervisores WHERE id = 5");
			$this->db->query("ALTER TABLE `tecnicos` ADD `fecha_cese` INT(11) NOT NULL DEFAULT '0' AFTER `publish`, ADD `motivo_cese` TEXT NULL AFTER `fecha_cese`;");
			$this->db->query("ALTER TABLE `supervisores` ADD `fecha_cese` INT(11) NOT NULL DEFAULT '0' AFTER `publish`, ADD `motivo_cese` TEXT NULL AFTER `fecha_cese`;");
			$this->db->query("ALTER TABLE `jefes` ADD `fecha_cese` INT(11) NOT NULL DEFAULT '0' AFTER `publish`, ADD `motivo_cese` TEXT NULL AFTER `fecha_cese`;");


			/*$fields = $this->db->list_fields('motivos');
foreach ($fields as $field)
{
   echo $field . '<br>';
}*/
				//$this->db->query("DELETE FROM logsolicitudesrf WHERE sid = ''");
				//$query = $this->db->query("SELECT * FROM motivos WHERE estadoid = 3");
				//var_dump($query->result());
			?>
			<br>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col"><span>N° SOT</span></th>
						<th scope="col"><span>TIPO SERVICIO</span></th>
						<th scope="col"><span>NOMBRE CLIENTE</span></th>
						<th scope="col"><span>DISTRITO - DPTO</span></th>
						<th scope="col"><span>PLANO</span></th>
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