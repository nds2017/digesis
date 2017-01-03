      </div>
      <script src="<?=base_url()?>js/departamentos.js"></script>

      <div class="list-mod-panel">
        <h1 style="float: left;"> Asistencia de Técnicos &nbsp;&nbsp;</h1>
        <h2><a href="<?=base_url()?>index.php/solicitudes/form/add">Añadir Solicitud</a></h2>
      </div>
      <br>
      <fieldset class="search">
        <legend></legend>
         <form class="form-inline" role="form" id="frmasistencia">
        <h2 class="form-signin-heading">Asistencia de T&eacute;cnicos</h2>
        <h4 class="form-signin-heading">Fecha: <?php echo date('l, j \of  F Y') ?></h4>
        <div class="form-group">
          <label for="ejemplo_email_1">Fecha:</label>
          <input type="text" class="form-control" id="fecha" name="fecha" placeholder="Fecha">
          <input type="hidden" class="form-control" id="date" name="date" value="<?php echo $date ?>">
        </div>
        <button type="button" class="btn btn-success" id="btnbuscar">Buscar</button>     
      </fieldset>
      <br>
      <table class="table table-bordered table-striped">      
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombres</th>
                  <th>Asistencia</th>
                  <th>Descanso</th>
                  <th>Motivo</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // echo '<pre>';
                // var_dump($result);
                // echo '</pre>';
                if(!empty($result)){
                  foreach ($result as $key => $val) {
                    $asistio = '';
                    $falto = '';
                    $motivo = '';
                    if(isset($val->asistio) && isset($val->falto) && isset($val->motivo)){
                      $asistio = ($val->asistio == '1') ? 'checked="checked"' : '';
                      $falto = ($val->falto == '1') ? 'checked="checked"' : '';
                      $motivo = (trim($val->motivo) != '') ? $val->motivo : '';
                    }
                  ?>
                  <tr>
                    <td><?php echo $val->id ?></td>
                    <input type="hidden" id="id-<?php echo $val->id ?>" name="id-<?php echo $val->id ?>" value="<?php echo $val->id ?>">
                    <td><?php echo $val->nombres ?></td>
                    <td><input type="checkbox" class="form-control" id="asistencia-<?php echo $val->id ?>" name="asistencia-<?php echo $val->id ?>" <?php echo $asistio ?> value="1"></td>
                    <td><input type="checkbox" class="form-control" id="descanso-<?php echo $val->id ?>" name="descanso-<?php echo $val->id ?>" <?php echo $falto ?> value="1" ></td>
                    <td><input type="text" class="form-control" id="motivo-<?php echo $val->id ?>" name="motivo-<?php echo $val->id ?>" placeholder="Motivo" value="<?php echo $motivo ?>"></td>
                  </tr>
                  <?php
                  }
                }
              ?>
                <tr>
                  <td colspan="5">Total Registros: <?php echo count($result) ?></td>
                </tr>
                <input type="hidden" id="cantidad" name="cantidad" value="<?php echo count($result) ?>">
              </tbody>
            </table>
            </form>
    </div>
  </div>
</body>
</html>



