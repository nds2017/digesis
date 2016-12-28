			</div>

			<div class="list-mod-panel">
				<h1 style="float: left;"> Reportes / Encuestas / JEFE &nbsp;&nbsp;</h1>
			</div>
			<br><br><br>
			<table class="table tableseg table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col"><span>JEFE</span></th>
						<th scope="col"><span>SUPERVISORES</span></th>
						<th scope="col"><span>PROMEDIO</span></th>
					</tr>
				</thead>
				<?php if ( isset($data) && count($data) ) { ?>
				<tbody>
				<tr>
					<td><strong><?=$jefes[$jefeid]?></strong></td>
					<td><strong>-</strong></td>
					<td><strong><?=isset($data['promedio'])?$data['promedio']:'-'?></strong></td>
				</tr>
					<?php if ( isset($data['supervisores']) && count($data['supervisores']) ) { ?>
					<?php foreach ( $data['supervisores'] as $supid => $data_s ) { ?>
					<tr>
						<td><strong>-</strong></td>
						<td><strong><?=$supervisores[$supid]?></strong></td>
						<td><strong><?=isset($data_s['promedio'])?$data_s['promedio']:'-'?></strong></td>
					</tr>
					<?php } ?>
					<?php } ?>
				</tbody>
				<?php } ?>
			</table>
			<br><br>
			<div class="tableseg">
				<input class="btnsearch" type="button" value="Regresar" onclick="window.location='<?=base_url()?>index.php/reportes/encuestas';">
			</div>
		</div>
	</div>
</body>
</html>