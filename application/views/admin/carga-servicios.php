			<script type="text/javascript">
				
		$(document).ready(function(){
    		var table =$('#myTable').DataTable( {
		        "language": {
        		"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        		}
    		});

			$('#myTable tbody').on( 'click', 'tr', function () {
			        if ( $(this).hasClass('selected') ) {
			            $(this).removeClass('selected');
			        }
			        else {
			            table.$('tr.selected').removeClass('selected');
			            $(this).addClass('selected');
			        }
			    } );
			 
			    $('#button').click( function () {
			        table.row('.selected').remove().draw( false );
			    } );

		});

			</script>
			</div>
			<h2>Cargar Servicios</h2><br>						
			<form method="post" enctype="multipart/form-data">
			 <div class="form-group">
				<label for="exampleInputFile"></label>
				<input type="file" name="file" id="exampleInputFile">
				<p class="help-block">Seleccione un archivo csv.</p>
				</div>					
			<input class="btn" style="margin: 0px;" name="carga" type="submit" value="Cargar" />
			<br><br>
			<?php if ( @$error ) echo $error; ?>
			</form>					
			<hr style="border: 1px blue solid">			
			<br>

		<div class="row" style="border: solid 1px #b3b3b3;margin-left: 10px; margin-right: 10px;padding-top:10px; margin-bottom: 15px;">
			  <div class="col-xs-2">
			    <input type="text" class="form-control" placeholder="servicio">
			  </div>
			  <div class="col-xs-2">
			    <input type="text" class="form-control" placeholder="categoria">
			  </div>
			  <div class="col-xs-2">
			    <input type="text" class="form-control" placeholder="motivos">
			  </div>
			  <div class="col-xs-2">
			    <input type="text" class="form-control" placeholder="fotos">
			  </div>
			  <div class="col-xs-2">
			  <input type="submit" value="Agregar" class="btn"></input>
			  </div>

			</div>

			<table class="table table-striped table-bordered" id="myTable">
				<thead>
				<tr>
					<th scope="col"><span>N°</span></th>			
					<th scope="col"><span>Servicio a ejecutar</span></th>
					<th scope="col"><span>Categoria</span></th>
					<th scope="col"><span>Motivos de solucion</span></th>
					<th scope="col"><span>Fotos</span></th>
					<th scope="col"><span>Accion</span></th>
				</tr>
				</thead>
				<?php if ( @$servicios ) { ?>
				<tbody>
				<?php foreach (@$servicios as $i => $row ) { ?>
				<tr>
					<td><strong><?=$row->id ?></strong></td>
					<td><strong><?=$row->descripcion ?></strong></td>
					<td><strong><?=$row->categoria ?></strong></td>
					<td><strong><?=$row->motivos ?></strong></td>
					<td><strong><?=$row->fotos ?></strong></td>
					<td><strong><a href="">Eliminar</a></strong></td>
				</tr>
				<?php } ?>
				</tbody>
				<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>