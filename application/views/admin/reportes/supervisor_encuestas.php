			</div>

			<div class="list-mod-panel">
				<h1 style="float: left;"> Reportes / Encuestas / SUPERVISOR &nbsp;&nbsp;</h1>
			</div>
			<br><br><br>
			<table class="table tableseg table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col"><span>SUPERVISOR</span></th>
						<th scope="col"><span>TÉCNICOS</span></th>
						<th scope="col"><span>PROMEDIO</span></th>
					</tr>
				</thead>
				<?php if ( isset($data) && count($data) ) { ?>
				<tbody>
				<tr>
					<td><strong><?=$supervisores[$supid]?></strong></td>
					<td><strong>-</strong></td>
					<td><strong><?=isset($data['promedio'])?$data['promedio']:'-'?></strong></td>
				</tr>
					<?php if ( isset($data['tecnicos']) && count($data['tecnicos']) ) { ?>
					<?php foreach ( $data['tecnicos'] as $tid => $data_t ) { ?>
					<tr>
						<td><strong>-</strong></td>
						<td><strong><?=$tecnicos[$tid]?></strong></td>
						<td><strong><?=isset($data_t['promedio'])?$data_t['promedio']:'-'?></strong></td>
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