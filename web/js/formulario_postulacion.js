$(document).ready(function(){	
	
	
	$("#cmdback").click(function(){		
		window.history.back();
	});

	$( "#candidato-ruc" ).keypress(function(e) {		
		cleanForm();
	});

	$("#candidato-ruc").change(function(){
		var validRuc = /^[0-9]{10}001$/		
		if(validRuc.test($(this).prop("value"))){	
                    cleanForm();
                    $("#loading_message").show();						
                    //Obtiene la información de una empresa
                   var str_url="/ecuadorcompraecuador/soap_client/juridico.php?ruc="+$(this).prop("value");
                     // var str_url="/soap_client/juridico.php?ruc="+$(this).prop("value");
                    $.ajax({
                      url: str_url,
                      dataType:"json",
                      type:"post",			  		  		  
                      success:function(data){	
                        $("#candidato-representante_legal").prop("value","");							
                        $("#candidato-razon_social").prop("value","");							
                        $("#candidato-actividad_general").prop("value","");							
                        $("#candidato-tipo_contribuyente").prop("value","");							
                        $("#candidato-telefono_domicilio").prop("value","");							
                        $("#candidato-correo_electronico").prop("value","");							
                        $("#candidato-correo_electronico").prop("value","");
                        $("#candidato-numero").prop("value","");			
                        if(data.success){			
                            $("#candidato-representante_legal").prop("value",data.nombreRepresentanteLegal);
                            $("#candidato-razon_social").prop("value",data.razonSocial);
                            $("#candidato-actividad_general").prop("value",data.actividadEconomicaPrincipal);
                            $("#candidato-tipo_contribuyente").prop("value",data.tipoContribuyente);
                            $("#candidato-telefono_domicilio").prop("value",data.telefonos);
                            $("#candidato-correo_electronico").prop("value",data.email);
                            $("#candidato-calle").prop("value",data.direccionCorta);
                            separar=data.direccionCorta.split();
                            
                            $("#candidato-numero").prop("value","");
                        }else{

                        }
                            $("#loading_message").hide();
                      }
                    });	
		}		
	});	

	function cleanForm(){
            $("#candidato-representante_legal").prop("value","");							
            $("#candidato-razon_social").prop("value","");							
            $("#candidato-actividad_general").prop("value","");							
            $("#candidato-tipo_contribuyente").prop("value","");							
            $("#candidato-telefono_domicilio").prop("value","");							
            $("#candidato-correo_electronico").prop("value","");							
            $("#candidato-calle").prop("value","");		
	}	


  	$("#candidato-provincia_id").change(function() {
            $("#candidato-canton_id").html("<option> Cargando ...</option>");
	});


});	