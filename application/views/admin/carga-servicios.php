			<script type="text/javascript">
				
		$(document).ready(function(){
    		$('#myTable').DataTable( {
		        "language": {
        		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        		}
    		});
		});

			</script>
			</div>
			<h2>Cargar Servicios</h2><br>						
			<form method="post" enctype="multipart/form-data">
			 <div class="form-group">
				<label for="exampleInputFile"></label>
				<input type="file" id="exampleInputFile">
				<p class="help-block">Seleccione un archivo csv.</p>
				</div>					
			<input class="btn" style="margin: 0px;" name="carga" type="submit" value="Cargar" />
			<br><br>
			<?php if ( @$error ) echo $error; ?>
			</form>					
			<hr style="border: 1px blue solid">
			<?php
				if ( !@$error && @$_POST['carga'] )
					echo '<em>' . $info->filas . ' Registros Procesados <br>' . $info->add . ' Registros Agregados <br>' . $info->update . ' Registros Actualizados</em><hr>';
			?>

			
			<?php
				//$this->db->query("ALTER TABLE `solicitudes` ADD `hora` VARCHAR(5) NOT NULL DEFAULT '00:00' AFTER `horario`;");

			/*$fields = $this->db->list_fields('solicitudesprogramadas');
foreach ($fields as $field)
{
   echo $field . '<br>';
}
				$query = $this->db->query("SELECT * FROM solicitudesprogramadas");
				print_r($query->result());*/
			?>
			<br>
			<table class="table table-striped table-bordered" id="myTable">
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