$(function() {

  $( "#fecha" ).datepicker();
  $( "#fecha" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

  // $( "#frmasistencia" ).on( "change", "#fecha", function() {
  //   $( "#date" ).val($( "#fecha" ).val());
  // });


  $( "#frmasistencia" ).on( "click", "#btnbuscar", function() {
      var fecha = $('#frmasistencia #fecha').val();
      console.log(fecha);
      var url =  '/index.php/asistencia/buscar/' + fecha;

      $.ajax({
        url : url,
        data : {fecha : fecha},
        type : 'GET',
        dataType : 'json',
        success : function(json) {
            // window.location.href = url;
            // history.pushState(null, "", url);
            //alert('okk');
            $('#resultadoasistencia').html(json.result);
        },
        error : function(xhr, status) {
             alert('Disculpe, existió un problema');
        },
        complete : function(xhr, status) {
            // alert('Petición realizada');
        }
      });

      $( "#date" ).val($( "#fecha" ).val());

  });

  $( "#grabar" ).on( "click", function() {
      var fecha = $('#fecha').val();
      var url = '/index.php/asistencia/grabar';

      var data = $('#frmasistencia').serialize();
      alert(data);
      $.ajax({
        url : url,
        data : {data : data},
        type : 'POST',
        dataType : 'json',
        success : function(json) {
              alert('Asistencia guardada correctamente');
            // window.location.href = url;
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

});
