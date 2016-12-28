			</div>

			<div class="list-mod-panel">
				<h1 style="float: left;"> Reportes / Encuestas / TÉCNICO &nbsp;&nbsp;</h1>
			</div>
			<br><br><br>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col"><span>TÉCNICO</span></th>
						<th scope="col"><span>SOLICITUD</span></th>
						<th scope="col"><span>FECHA</span></th>
						<th scope="col"><span>Preg. 1</span></th>
						<th scope="col"><span>Preg. 2</span></th>
						<th scope="col"><span>Preg. 3</span></th>
						<th scope="col"><span>Preg. 4</span></th>
						<th scope="col"><span>Preg. 5</span></th>
						<th scope="col"><span>PROMEDIO</span></th>
					</tr>
				</thead>
				<?php if ( isset($data) && count($data) ) { ?>
				<tbody>
				<tr>
					<td><strong><?=$tecnicos[$tid]?></strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong>-</strong></td>
					<td><strong><?=isset($data['promedio'])?$data['promedio']:'-'?></strong></td>
				</tr>
					<?php if ( isset($data['solicitudes']) && count($data['solicitudes']) ) { ?>
					<?php foreach ( $data['solicitudes'] as $solicitud ) { ?>
					<tr>
						<td><strong>-</strong></td>
						<td><strong><?=$solicitud->id?></strong></td>
						<td><strong><?=$solicitud->fecha_instalacion?></strong></td>
						<?php foreach ( $solicitud->encuestas as $value ) { ?>
							<td><strong><?=$value?></strong></td>
						<?php } ?>
						<td><strong><?=isset($solicitud['promedio'])?$solicitud['promedio']:'-'?></strong></td>
					</tr>
					<?php } ?>
					<?php } ?>
				</tbody>
				<?php } ?>
			</table>
			<br><br>
			<input class="btnsearch" type="button" value="Regresar" onclick="window.location='<?=base_url()?>index.php/reportes/encuestas';">
		</div>
	</div>
</body>
</html>