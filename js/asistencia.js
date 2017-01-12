$(function() {

  $( "#fecha" ).datepicker();
  $( "#fecha" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

  // $( "#frmasistencia" ).on( "change", "#fecha", function() {
  //   $( "#date" ).val($( "#fecha" ).val());
  // });

$( "#frmmonedero" ).on( "click", "#btnbuscar", function() {        
      var fecha = $('#frmmonedero #fecha').val();          
      var perfil = $("#tecnico1id").val();
      var supervisor = $("#supervisorid").val();
      
      window.location.href = '/index.php/monedero?perfil='+perfil+'&fecha='+fecha+'&supervisor='+supervisor;
});
/*
$( "#frmmonedero" ).on( "click", "#btnbuscar", function() {      
      var fecha = $('#frmmonedero #fecha').val();          
      var dni = $("#tecnico1id").val();
      window.location.href = '/index.php/monedero?dni='+dni+'&fecha='+fecha;      
});
*/

  $( "#frmasistencia" ).on( "click", "#btnbuscar", function() {
      var fecha = $('#frmasistencia #fecha').val();
      var dni = $('#frmasistencia #dni').val();
      console.log(dni);
      var url =  '/index.php/asistencia/buscar/' + fecha+'&dni='+dni;
      window.location.href = '/index.php/asistencia?fecha='+fecha+'&dni='+dni;
    /*
      $.ajax({
        url : url,
        data : {fecha : fecha},
        type : 'GET',
        dataType : 'json',
        success : function(json) {
            // window.location.href = url;
            // history.pushState(null, "", url);
            //alert('okk');
            window.location.href = '/index.php/asistencia?fecha='+fecha;
            //$('#resultadoasistencia').html(json.result);
        },
        error : function(xhr, status) {
             alert('Disculpe, existió un problema');
        },
        complete : function(xhr, status) {
            // alert('Petición realizada');
        }
      });*/

    $( "#date" ).val($( "#fecha" ).val());

  });

  $( "#grabar" ).on( "click", function() {
      var fecha = $('#fecha').val();
      var dni = $('#dni').val();
      var result = $('#result').val();

      if (result=='result2')
        var url = '/index.php/asistencia/grabar';
      else
        var url= '/index.php/asistencia/grabar';

      var data = $('#frmasistencia').serialize();    
      $.ajax({
        url : url,
        data : {data : data},
        type : 'POST',
        dataType : 'json',
        success : function(json) {
              alert('Asistencia guardada correctamente');
              window.location.href = '/index.php/asistencia?fecha='+fecha+'&dni='+dni;
            // history.pushState(null, "", url);
            // $('#frmasistencia #resultadoasistencia').html(json.result);
        },
        error : function(xhr, status) {
             alert('Disculpe, existió un problema');
        },
        complete : function(xhr, status) {
            // alert('Petición realizada');
        }
      });
  });


$( "a#idsupervisor.supervisor_detalle" ).on( "click", function() {
  alert("xxx");
});



});
