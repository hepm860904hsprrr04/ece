/*$(document).ready(function(){	
	        
    setInterval(function(){

       verificarOperaoresDisponibles()
        
   }, 5000);
   
   verificarOperaoresDisponibles();
    function verificarOperaoresDisponibles(){        
        $.ajax({
            url: "?r=site/chat",
            method:'get',
			dataType:'json',            
        }).done(function(response) {
			console.log(response);
			if(response.disponibles){
				$("a[id=link_no_disponibles]").hide();					
				$("a[id=link_disponibles]").show();		
				
				
			}else{				
				$("a[id=link_disponibles]").hide();					
				$("a[id=link_no_disponibles]").show();				
			}
        });  
        
      
    }     
   
});   */