
<table class="table table-bordered">
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
        <td><?php echo $val->idTecnico ?></td>
        <input type="hidden" id="idtecnico-<?php echo $val->idTecnico ?>" name="idtecnico-<?php echo $val->idTecnico ?>" value="<?php echo $val->idTecnico ?>">
        <td><?php echo $val->nombres ?></td>
        <td><input type="checkbox" class="form-control" id="asistencia-<?php echo $val->idTecnico ?>" name="asistencia-<?php echo $val->idTecnico ?>" <?php echo $asistio ?> value="1"></td>
        <td><input type="checkbox" class="form-control" id="descanso-<?php echo $val->idTecnico ?>" name="descanso-<?php echo $val->idTecnico ?>" <?php echo $falto ?> value="1" ></td>
        <td><input type="text" class="form-control" id="motivo-<?php echo $val->idTecnico ?>" name="motivo-<?php echo $val->idTecnico ?>" placeholder="Motivo" value="<?php echo $motivo ?>"></td>
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
