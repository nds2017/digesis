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
				$this->db->query("ALTER TABLE `solicitudes` ADD `modtime` INT NOT NULL AFTER `motivorf`, ADD `upload` TINYINT(1) NOT NULL DEFAULT '1' AFTER `modtime`, ADD `horario` TINYINT(1) NOT NULL DEFAULT '1' AFTER `upload`;");
				$this->db->query("CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int(11) NOT NULL,
  `nombreh` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;");
			$this->db->query("INSERT INTO `horarios` (`id`, `nombreh`) VALUES
(1, 'Mañana'),
(2, 'Tarde');");

			$fields = $this->db->list_fields('horarios');
foreach ($fields as $field)
{
   echo $field . '<br>';
}
				$query = $this->db->query("SELECT * FROM horarios");
				print_r($query->result());
			?>
			<br>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col"><span>N°</span></th>
						<th scope="col"><span>N° SOT</span></th>
						<th scope="col"><span>TIPO SERVICIO</span></th>
						<th scope="col"><span>NOMBRE CLIENTE</span></th>
						<th scope="col"><span>DISTRITO - DPTO</span></th>
						<th scope="col"><span>PLANO</span></th>
						<th scope="col"><span>FECHA PROGRAMACIÓN</span></th>
					</tr>
				</thead>
				<?php if ( @$data ) { ?>
				<tbody>
				<?php foreach ( $data as $i => $row ) { ?>
				<tr>
					<td><strong><?=$i+1?></strong></td>
					<td><strong><?=$row->id?></strong></td>
					<td><strong><?=$row->tsnombre?></strong></td>
					<td><strong><?=$row->cliente?></strong></td>
					<td><strong><?=$row->distrito . ' - ' . $row->dpto?></strong></td>
					<td><strong><?=$row->plano?></strong></td>
					<td><strong><?=date('d-m-Y', $row->fecha_instalacion)?></strong></td>
				</tr>
				<?php } ?>
				</tbody>
				<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>