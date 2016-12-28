			</div>
			<script src="<?=base_url()?>js/departamentos.js"></script>

			<div class="list-mod-panel">
				<h1 style="float: left;"> Reportes / Encuestas &nbsp;&nbsp;</h1>
			</div>
			<br>
			<fieldset class="search">
				<legend></legend>
				<form id="form" method="post" action="<?=base_url()?>index.php/reportes/encuestas">

					<input type="hidden" id="url" value="<?=base_url()?>index.php/solicitudes"/>
					Jefe :
					<select id="jefeid">
						<option value="0">-Seleccione-</option>
						<?php foreach ($jefes as $id => $jefe) { ?>
						<option <?=(@$jefeid==$id ? 'selected' : '')?> value=<?=$id?>><?=$jefe?></option>
						<?php } ?>
					</select>
					Provincia
					<select id="supervisorid" name="supervisorid">
						<?php if ( @$supervisorid ) { ?>
						<?php foreach ($supervisores as $id => $supervisor) { ?>
						<option <?=(@$supervisorid==$id ? 'selected' : '')?> value=<?=$id?>><?=$supervisor?></option>
						<?php } ?>
						<?php } ?>
					</select>
					Distrito:
					<select name="tecnicoid" id="tecnicoid">
						<?php if ( @$tecnicoid ) { ?>
						<?php foreach ($tecnicos as $id => $tecnico) { ?>
						<option <?=(@$tecnicoid==$id ? 'selected' : '')?> value=<?=$id?>><?=$tecnico?></option>
						<?php } ?>
						<?php } ?>
					</select>
					<input type="submit" class="btnsearch" value="Filtrar"/>
				</form>
			</fieldset>
			<br>
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th scope="col"><span>JEFE</span></th>
						<th scope="col"><span>SUPERVISORES</span></th>
						<th scope="col"><span>TÉCNICOS</span></th>
						<th scope="col"><span>PROMEDIO</span></th>
						<th scope="col"><span>DETALLE</span></th>
					</tr>
				</thead>
				<?php if ( isset($data) && count($data) ) { ?>
				<tbody>
				<!--<?php foreach ( $data as $row ) { ?>
				<tr>
					<td><strong><?=$row->id?></strong></td>
					<td><strong><?=$row->tsnombre?></strong></td>
					<td><strong><?=$row->cliente?></strong></td>
					<td><strong><?=$row->distrito . ' - ' . $row->dpto?></strong></td>
					<td><strong><?=$row->plano?></strong></td>
					<td><strong><?=$row->enombre?></strong></td>
					<td><a title="Ver Detalle" href="<?=base_url()?>index.php/solicitudes/form/<?=$row->id?>"><img src="<?=base_url()?>img/editar.png"></a></td>
				</tr>
				<?php } ?>-->
				<?='<pre>' . print_r($data) . '</pre>'?>
				</tbody>
				<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>