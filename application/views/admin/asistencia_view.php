<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Asistencia de T&eacute;cnicos</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>htdocs/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url() ?>htdocs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url() ?>htdocs/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url() ?>htdocs/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="<?php echo base_url() ?>htdocs/assets/js/asistencia.js"></script>

    <script>
    var base_url = '<?php echo base_url() ?>';
    </script>

  </head>

  <body>

    <div class="container">

      <form class="form-inline" role="form" id="frmasistencia">
        <h2 class="form-signin-heading">Asistencia de T&eacute;cnicos</h2>
        <h4 class="form-signin-heading">Fecha: <?php echo date('l, j \of  F Y') ?></h4>
        <div class="form-group">
          <label for="ejemplo_email_1">Fecha:</label>
          <input type="text" class="form-control" id="fecha" name="fecha" placeholder="Fecha">
          <input type="hidden" class="form-control" id="date" name="date" value="<?php echo $date ?>">
        </div>
        <button type="button" class="btn btn-success" id="btnbuscar">Buscar</button>
        <div>
          <div style="padding-top:10px;" id="resultadoasistencia">
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
          </div>
          <button type="button" class="btn btn-primary" id="grabar">Grabar</button>
        </div>
      </form>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url() ?>htdocs/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
