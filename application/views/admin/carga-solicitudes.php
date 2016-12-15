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
				$this->db->query("DELETE FROM supervisores WHERE id = 5");
			/*$this->db->query("INSERT INTO `motivos` (`id`, `motivo`, `estadoid`) VALUES
(1, 'PLANTA EXTERNA', 3),
(2, 'POR SISTEMAS', 3),
(3, 'VALIDACION REMOTA', 3),
(4, 'FACILIDADES DEL CLIENTE', 3),
(5, 'CONTRATISTA', 3),
(6, 'FACILIDADES INTERNAS', 3),
(7, 'PLANTA EXTERNA', 4),
(8, 'POR SISTEMAS', 4),
(9, 'PENDIENTE MANTTO PEX', 4),
(10, 'PENDIENTE ACTIVAS SISTEMAS', 4),
(11, 'PENDIENTE PROB. MASIVO SISTEMAS', 4),
(12, 'CLIENTE AUSENTE', 4),
(13, 'CLIENTE NO CON EQUIPO', 4),
(14, 'FACILIDADES INTERNAS', 4),
(15, 'POR LA CONTRATISTA', 4),
(16, 'POR FACILIDADES TECNICAS DEL CLIENTE', 4),
(17, 'POR SISTEMAS', 5),
(18, 'POR PORTABILIDAD NO EFECTUADA', 5),
(19, 'POR FALTA DE INFRAESTRUCTURA DE RED', 5),
(20, 'POR DUPLICIDAD', 5),
(21, 'POR CLIENTE POSIBLE FRAUDE', 5),
(22, 'POR NO DEFINE FECHA DE PROGRAMACION', 5),
(23, 'POR CLIENTE NO DESEA EL SERVICIO', 5),
(24, 'POR MALA OFERTA', 5),
(25, 'POR MUDANZA O VIAJE', 5),
(26, 'POR EXCESO DE ACOMETIDA', 5),
(27, 'POR FACILIDADES TECNICAS DEL CLIENTE', 5),
(28, 'POR ZONA PELIGROSA', 5);");


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