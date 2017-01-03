    </div>
      <script src="<?=base_url()?>js/departamentos.js"></script>
      <div class="list-mod-panel">
        <h1 style="float: left;"> Monedero &nbsp;&nbsp;</h1>        
        <h2><a href="/index.php/monedero">Regresar a Lista de resumen de cómision</a></h2>
      </div>
      <br>

  <fieldset class="search">
        <legend></legend>        
    <form class="form-inline" role="form" id="frmmonedero">
        <div class="container_buscar_fecha"> 
          <span class="" style="margin-bottom: 25px;">Fecha: <?php echo date('l, j \of  F Y') ?></span>

        <div class="form-group" style="margin-top: 15px;">

            <label style="display: block; float: left; width:6%" for="ejemplo_email_1">Tecnico:</label>
            

          <label style="display:block; float: left; width: 6%; margin-left:10px" for="ejemplo_email_1">DNI:</label>          

          <label style="display:block; float: left; width: 6%; margin-left:10px" for="ejemplo_email_1">Perfil:</label>          
          
        </div>      
        </div>
     </form>
  </fieldset>

      <br>
      <div style="padding-top:10px;" id="resultadoasistencia">      
      <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Cant.SOT</th>
              <th>Monto SOT</th>
              <th>Desc.Asist</th>
              <th>Desc.RF</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>
          <?php 
        if(!empty($detalle)):
          foreach($detalle as $key=>$value):
          ?>
          <tr>
            <td data-label="Fecha"><?php echo $value['fecha']; ?></td>
            <td data-label="Cant.SOT"><?php echo $value['sot']; ?></td>
            <td data-label="Monto SOT"><?php echo $value['monto'] ?></td>
            <td data-label="Desc.Asist"><?php echo $value['desc_asistencia'] ?></td>
            <td data-label="Desc.RF"><?php echo $value['desc_rf'] ?></td>
            <td data-label="Monto"><?php echo $value['total'] ?></td>
          </tr>
          <?php 
            endforeach;
          endif;  
          ?>  
          </tbody>            
        </table>
        <br/><br/><br/>

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>%eficiencia</th>
              <th>Monto Eficiencia</th>
              <th>Monto SOT</th>
              <th>Desc.Incidencia</th>
              <th>Pago del Mes</th>             
            </tr>
          </thead>
          <tbody>         
<?php
if(!empty($detalle)):
?>          
  <tr>
<td data-label="%eficiencia"><?php echo $resumen['comision_mes']['porcentaje']?></td>
<td data-label="Monto Eficiencia"><?php echo $resumen['comision_mes']['comision_mes_eficiencia']?></td>
  <td data-label="Monto SOT"><?php echo $resumen['comision_mes']['comision_mes_sot']?></td>
  <td data-label="Desc.Incidencia"><?php echo $resumen['comision_mes']['desc_mes_insidencia']?></td>
  <td data-label="Pago del Mes"><?php echo $resumen['comision_mes']['monto']?></td>
  </tr>
<?php endif;?>
          </tbody>
          </table>  
      </div>            