      </div>
      <script src="<?=base_url()?>js/departamentos.js"></script>

      <div class="list-mod-panel">
        <h1 style="float: left;"> Lista de Solicitudes &nbsp;&nbsp;</h1>
        <h2><a href="<?=base_url()?>index.php/solicitudes/form/add">Añadir Solicitud</a></h2>
      </div>
      <br>
      <fieldset class="search">
        <legend></legend>
        <form id="form" method="post" action="<?=base_url()?>index.php/solicitudes/lista/<?=@$estadoid?>">
          <nav class="top_menu">
            <ul>
              <li <?=(@$estadoid==0)?'class="active"':''?>><a href="<?=base_url()?>index.php/solicitudes/lista/0">Todos (<?=$cantidades[0]?>) &nbsp;&nbsp;|</a></li>
              <?php foreach ( $estados as $id => $estado ) { ?>
              <li <?=(@$estadoid==$id)?'class="active"':''?>><a href="<?=base_url()?>index.php/solicitudes/lista/<?=$id?>"><?=$estado?> (<?=isset($cantidades[$id]) ? $cantidades[$id] : 0?>) &nbsp;&nbsp;|</a></li>
              <?php } ?>
            </ul>
          </nav>

          <input type="hidden" id="url" value="<?=base_url()?>index.php/solicitudes"/>
          Departamento :
          <select id="dptoid">
            <option value="0">-Seleccione-</option>
            <?php foreach ($departamentos as $id => $departamento) { ?>
            <option <?=(@$departamentoid==$id ? 'selected' : '')?> value=<?=$id?>><?=$departamento?></option>
            <?php } ?>
          </select>
          Provincia
          <select id="provinciaid" name="provinciaid">
            <?php if ( @$distritoid ) { ?>
            <?php foreach ($provincias as $id => $provincia) { ?>
            <option <?=(@$provinciaid==$id ? 'selected' : '')?> value=<?=$id?>><?=$provincia?></option>
            <?php } ?>
            <?php } ?>
          </select>
          Distrito:
          <select name="distritoid" id="distritoid">
            <?php if ( @$distritoid ) { ?>
            <?php foreach ($distritos as $id => $distrito) { ?>
            <option <?=(@$distritoid==$id ? 'selected' : '')?> value=<?=$id?>><?=$distrito?></option>
            <?php } ?>
            <?php } ?>
          </select>
          <input type="submit" class="btnsearch" value="Filtrar"/>
          <br>
          N° SOT: <input type="text" size="10" name="solicitudid" value="<?=@$solicitudid?>"/>
          <input type="submit" class="btnsearch" value="Buscar"/>
        </form>
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
    </div>
  </div>
</body>
</html>



