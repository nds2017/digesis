
"use strict";

$( document ).ready(function() {
   
   
     var ID = function () {
	  var postfix="sid";
      return Math.random().toString(36).substr(2, 9)+'-'+postfix ;
    };  
   
     /*$( ".container-list .cont-solicitud" ).each(function( index ) {
		 var nkey=ID();
		 var n_item=$(this);
		 n_item.attr("id", nkey);
     });  */
   
$( "#datepicker1" ).datepicker({
	onSelect: function(dateText, inst) {
		//$(".schedule .calendar").hide();
		//$(".schedule .datetime").show();
		//$("#datepicker").trigger( "focus" );
		//$(".test").hide();
		//$(".client").hide();
		
    }
});

$( "#datepicker2" ).datepicker({
	onSelect: function(dateText, inst) {
		//$(".schedule .calendar").hide();
		//$(".schedule .datetime").show();
		//$("#datepicker").trigger( "focus" );
		//$(".test").hide();
		//$(".client").hide();
		
    }
});

//$( "#ui-datepicker-div" ).insertBefore(".schedule .ui-popup-options-contenido");
/*    $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
			onSelect: function(dateText, inst) {
				$(".schedule .calendar").hide();
				$(".schedule .datetime").show();
				$(".test").hide();
				$(".client").hide();
				
			}
    })
    .hide()
    .click(function() {
      $(this).hide();
    });

    $("#datepickerImage").click(function() {
       $("#datepicker").show(); 
    });*/


$(".cont-solicitud .combo-ui" ).each(function() {
	
 
  var t=$( this );
  //var sid=t.parent().attr("id");
  var sid=t.parent().attr("data-codigo");
  //console.log(sid);
  var sel=t.find("select");
  	//sel.val("Pendiente");
	//sel.find("option[value='Pendiente']").attr('selected','selected');
	sel.change(function() {
	  var opt=sel.find("option:selected");
	  var choice=opt.text();
	  //console.log(choice);
	  var rule=(choice==="Rechazado");
	  var rule2=(choice==="Validado");
	  var rule3=(choice==="Reprogramado");
	  var rule4=(choice==="Pendiente");	  
		//var a=t.next(".label.combo-ui-lnk");
		
		//var b=a.next(".combo.combo-ui-lnk");
		//var sel2=b.find("select");
		//var c=b.next(".reason.combo-ui-lnk");
		//var d=c.next(".poll.combo-ui-lnk");		
		//sel2.change(function() {
			//c.removeClass("btn-inactive");
		//}); 
		
	  if(rule){
		//a.removeClass("display-none");
		//b.removeClass("display-none");
		//c.removeClass("display-none");
		//d.addClass("display-none");
		$(".ui-popup-options").show();
		$( ".client-box" ).addClass('display-none');
		$(".ui-popup-options-list li a").removeClass("active");
		$(".test").hide();
		$(".client").hide();
		$(".schedule").hide();
		$(".reject").show();
		$(".schedule .datetime").show();
		$(".schedule .calendar").show();
		$(".reject").find("#reject-sid").val(sid);
		
	  }else if(rule2){
		//a.addClass("display-none");
		//b.addClass("display-none");
		//c.addClass("display-none");
		//c.addClass("btn-inactive");
		//d.addClass("display-none");
		$(".ui-popup-options").show();
		$( ".client-box" ).addClass('display-none');
		$(".ui-popup-options-list li a").removeClass("active");
		$(".test").show();
		$(".client").hide();
		$(".schedule").hide();
		$(".reject").hide();
		$(".schedule .datetime").show();
		$(".schedule .calendar").show();
		$(".test").find("#test-sid").val(sid);
		//console.log("validado");
		
	  }else if(rule3){
		//a.addClass("display-none");
		//b.addClass("display-none");
		//c.addClass("display-none");
		//c.addClass("btn-inactive");
		//d.addClass("display-none");
		$(".ui-popup-options").show();
		$( ".client-box" ).addClass('display-none');
		$(".ui-popup-options-list li a").removeClass("active");
		$(".test").hide();
		$(".client").hide();
		$(".schedule").show();
		$(".reject").hide();
		$(".schedule .datetime").show();
		$(".schedule .calendar").show();	
		$("#datepicker").trigger( "focus" );
		$(".schedule").find("#schedule-sid").val(sid);
		//console.log("reprogramado")
	  }else if(rule4){
		//a.addClass("display-none");
		//b.addClass("display-none");
		///c.addClass("display-none");
		//c.addClass("btn-inactive");
		//d.addClass("display-none");
		$(".ui-popup-options").show();
		$( ".client-box" ).addClass('display-none');
		$(".ui-popup-options-list li a").removeClass("active");
		$(".test").hide();
		$(".client").show();
		$(".schedule").hide();
		$(".reject").hide();
		$(".schedule .datetime").show();
		$(".schedule .calendar").show();
		//console.log("pendiente");
		$(".test").find("#test-sid").val(sid);
		$( "#datepicker" ).datepicker('setDate', null);	
		  
	  }else{
		//a.addClass("display-none");
		//b.addClass("display-none");
		//c.addClass("display-none");
		//c.addClass("btn-inactive");
		//d.addClass("display-none");
		
		$(".ui-popup-options").hide();
		$( ".client-box" ).addClass('display-none');
		$(".ui-popup-options-list li a").removeClass("active");
		$(".test").hide();
		$(".client").hide();
		$(".schedule").hide();
		$(".reject").hide();
		$(".schedule .datetime").show();
		$(".schedule .calendar").show();
		
	  }
	  
	  
	});  


});

if($(".cont-login").length!==0){
	//console.log("login-frm detected");
	$(".input_f").focusin(function() {
		var current=$(this).attr("value");
		if((current==="") || (current==="DNI")){
			$(this).attr("value","");
		}
		
		
	}); 	
	$(".input_f").blur(function() {
		
		$(this).attr("value","DNI");
		
	});
	
		$(window).keyup(function (e) {
			var code = (e.keyCode ? e.keyCode : e.which);
			
			if (code == 9 && $('.input_f:focus').length) {
				
				$(this).attr("value","");
			}
		});
	
		
}


if($(".cont-login.thanks").length!==0){
	//console.log("login-thanks detected");
	$("form input").click(function(event) {
		event.preventDefault();
		var sendme='login.html';
		$(location).attr('href',sendme);
	}); 	

}



//


//TABS
	if($("#tab-ui").length!==0){


		var ui_tabs=function(){
								var wrapW=$(".wrapper").width();
								//console.log(wrapW);
								var slides=$(".ui-tab-item").length;
								//console.log("slides:"+slides);
								var fwrap=wrapW*slides;
								$(".ui-container-tab").width(fwrap);
								var wrapH=$(".ui-tab-item").height();
								$(".ui-container-tab").height(wrapH);
								$(".wrap-ui-container-tab").height(wrapH);
								$(".wrap-ui-container-tab").width(wrapW);
								$(".ui-tab-item").width(wrapW);
								$(".ui-container-tab").attr("style","position:absolute");
								
								$(".ui-tabs-links li a").click(function (event) {
										event.preventDefault();

										$(".ui-tabs-links li").removeClass("active");
										$(this).parent().addClass("active");
										



										var i = $(this).parent().index();
										$(".ui-tab-item").removeClass("active");
										$(".ui-tab-item").eq(i).addClass("active");
										var nH = $(".ui-tab-item.active").height();
										$(".ui-container-tab").height(nH);
										$(".wrap-ui-container-tab").height(nH);	
																			//console.log("i:"+i);
										var cpos=$(".ui-container-tab").css("left").replace("px","");
										//console.log("cpos:"+cpos);
										
										var npos=-(wrapW*i);

										//console.log("npos:"+npos);
										$(".ui-container-tab").attr("style","width:"+fwrap+"px; height:"+nH+"px;position:absolute;left:"+npos+"px;");
								});

		}

		ui_tabs();

		window.addEventListener("resize", function() {
		   ui_tabs();

		}, false);

		window.addEventListener("orientationchange", function() {
		   ui_tabs();

		}, false);

		
	}
	//POPUP
	function hidepop(){
		$(".ui-popup-options").fadeOut("fast");
	};

	//CANCEL
	if($(".cancel").length!==0){
			$(".cancel").click(function(event) {
				event.preventDefault();
				hidepop();
			});
	}


	if($(".ui-popup-options").length!==0){	
		$(".ui-popup-options-contenido .icon-cerrar").click(function(event) {
			//$(this).parent().parent().parent().parent().hide();
			event.preventDefault();
			
			//setTimeout(hidepop, 500);
			
			$( "#datepicker" ).datepicker('setDate', null);
		});	
		$(".ui-popup-options-contenido .icon-client").click(function(event) {
			$( ".client-box" ).removeClass('display-none');
		});
	$("#datepicker").blur(function() {
		
		//$("#datepicker").trigger( "focus" );
		
	});
	
	$(".ui-popup-options-list" ).each(function() {
			var t=$(this);
			t.find("li a").click(function(event) {
				event.preventDefault();
				t.find("li a").removeClass("active");
				var s=$(this);
				if (s.hasClass('icon-encuestar')) {
					location.href = "../index.php/encuestas/indicaciones/" + $("#test-sid").val();
				}
				s.addClass("active");
			});
	});	



	$(".ui-popup-close").click(function(event) {
		event.preventDefault();
			setTimeout(hidepop, 500);
	});	

		//console.log("..popup");
		
	}
	if($(".indications").length!==0){
		$(".indications ul li a").click(function(event) {
			event.preventDefault();
			$(".indications ul li a").removeClass("active");
			$(this).addClass("active");
		});
	}	
	
});