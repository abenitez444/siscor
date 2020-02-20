//busca caracteres que no sean espacio en blanco en una cadena
function vacio(q) {
        for ( i = 0; i < q.length; i++ ) {
                if ( q.charAt(i) != " "  ) {
                        return true
                }
        }
        return false
}
//valida que el campo no este vacio y no tenga solo espacios en blanco
function valida(obj,perf_user,dire_user) {

frm=obj.form;
valor=frm.tmp_valor.value;
if (valor==""){
	    alert("Debe Indicar un Item de la Consulta");
	    return false

}
else
{
switch(valor)
	{
		 case "num_remision": 
		 {
			 if (vacio(frm.ano_consulta.value)==false)
			 {
			    alert("Debe Indicar el A\u00f1o de la Consulta");
			    frm.ano_consulta.focus();
			    return false
			 }
			 if (vacio(frm.num_remision.value)==false)
			 {
			    alert("Debe Indicar el N\u00famero de Correlativo");
			    frm.num_remision.focus();
			    return false
			 }
		     
		 break;		
		 } 
		 case "num_remitida": 
		 {
			 if (vacio(frm.ano_consulta.value)==false)
			 {
			    alert("Debe Indicar el A\u00f1o de la Consulta");
			    frm.ano_consulta.focus();
			    return false
			 }			 
			 if (vacio(frm.num_remitida.value)==false)
			 {
			    alert("Debe Indicar el N\u00famero de Correlativo");
			    frm.num_remitida.focus();
			    return false
			 }

		     break;
		} 
		case "fecha":
		{
			if (vacio(frm.fecha_desde.value)==false)
			{
			    alert("Debe Indicar la Fecha Desde");
			    frm.fecha_desde.focus(); 
			    return false
			}
			if (vacio(frm.fecha_hasta.value)==false)
			{
			    alert("Debe Indicar la Fecha Hasta");
			    frm.fecha_hasta.focus(); 
			    return false
			}
	     break;
		 } 
		 case "direccion":
		 {
			if (frm.alto_nivel.selectedIndex==0)
			{
			   alert("Debe Seleccionar el Alto Nivel"); 
			   frm.alto_nivel.focus();
			   return false
			}	
			if (frm.primer_nivel.selectedIndex==0)
			{
			   alert("Debe Seleccionar el Primer Nivel"); 
			   frm.primer_nivel.focus();
			   return false
			}
			if (perf_user==1)
			{//codigo comentado abri como prueba de user
				
				if (dire_user!=0)
				{	
					if (frm.todos.checked!=true) 
					{
						if (frm.unidades.selectedIndex==0)
						{
							alert("Debe Seleccionar una Unidad"); 
							frm.unidades.focus();
							return false
						}  
					}
				}
			}//cierre del codigo comentado de prueba
			if (perf_user==2)
			{
				if (frm.coordinaciones.selectedIndex==0)
				{
					alert("Debe Seleccionar una Coordinaci\u00f3n"); 
					frm.coordinaciones.focus();
					return false
				}  
			
			}
			if (vacio(frm.fecha_desde.value)==false)
			{
			    alert("Debe Indicar la Fecha Desde");
			    frm.fecha_desde.focus(); 
			    return false
			}
			if (vacio(frm.fecha_hasta.value)==false)
			{
			    alert("Debe Indicar la Fecha Hasta");
			    frm.fecha_hasta.focus(); 
			    return false
			}
	
		     break;
		 }
	}

return true      
}
}

function activa_opcion(valor1,valor2,valor3)
{
	frm_remisiones.tmp_valor.value = valor1;//valor de prueba
	var fecha_actual = new Date()
	
	var anio = fecha_actual.getFullYear() 
	switch(valor1)
	{
		 case "num_remision": 
		 {
			 document.getElementById('anioconsulta').style.visibility='visible';
			 document.getElementById('nucorrelativo').style.visibility='visible';
			 document.getElementById('nuremitida').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';				 
			 frm_remisiones.ano_consulta.disabled = false;
			 frm_remisiones.ano_consulta.value = anio;
		     frm_remisiones.num_remision.disabled = false;
		     frm_remisiones.num_remitida.disabled = true;
		     frm_remisiones.fecha_desde.disabled = true;
		     frm_remisiones.fecha_hasta.disabled = true;
		     frm_remisiones.alto_nivel.disabled = true;
		     frm_remisiones.unidades.disabled = true;
		     frm_remisiones.primer_nivel.disabled = true;
		     frm_remisiones.direcciones.disabled = true;
		     frm_remisiones.todos.disabled = true;
		     if(valor3!=1)
		     {
		     frm_remisiones.coordinaciones.disabled = true;
		     }
		     
		     frm_remisiones.tmp_valor.value = valor1;
		     frm_remisiones.num_remision.value = "";
		     frm_remisiones.num_remitida.value = "";
		     frm_remisiones.fecha_desde.value = "";
		     frm_remisiones.fecha_hasta.value = "";
		 break;		
		 } 
		 case "num_remitida": 
		 {
			 document.getElementById('anioconsulta').style.visibility='visible';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuremitida').style.visibility='visible';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';				 
			 frm_remisiones.ano_consulta.disabled = false;
			 frm_remisiones.ano_consulta.value = anio;
		     frm_remisiones.num_remision.disabled = true;
		     frm_remisiones.num_remitida.disabled = false;
		     frm_remisiones.fecha_desde.disabled = true;
		     frm_remisiones.fecha_hasta.disabled = true;
		     frm_remisiones.alto_nivel.disabled = true;
		     frm_remisiones.primer_nivel.disabled = true;
		     frm_remisiones.direcciones.disabled = true;
		     frm_remisiones.unidades.disabled = true;
		     frm_remisiones.todos.disabled = true;
		     if(valor3!=1)
		     {
		     frm_remisiones.coordinaciones.disabled = true;
		     }
		     
		     frm_remisiones.tmp_valor.value = valor1;
		     frm_remisiones.num_remision.value = "";
		     frm_remisiones.num_remitida.value = "";
		     frm_remisiones.fecha_desde.value = "";
		     frm_remisiones.fecha_hasta.value = "";
		     break;
		} 
		case "fecha":
		{
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuremitida').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='visible';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';					
			 frm_remisiones.ano_consulta.disabled = true;
		     frm_remisiones.num_remision.disabled = true;
		     frm_remisiones.num_remitida.disabled = true;
		     frm_remisiones.fecha_desde.disabled = false;
		     frm_remisiones.fecha_hasta.disabled = false;
		     frm_remisiones.alto_nivel.disabled = true;
		     frm_remisiones.primer_nivel.disabled = true;
		     frm_remisiones.direcciones.disabled = true;
		     frm_remisiones.unidades.disabled = true;
		     frm_remisiones.todos.disabled = true;
		     if(valor3!=1)
		     {
		     frm_remisiones.coordinaciones.disabled = true;
		     }
		     frm_remisiones.tmp_valor.value= valor1;
		     frm_remisiones.ano_consulta.value = "";
		     frm_remisiones.num_remision.value = "";
		     frm_remisiones.num_remitida.value = "";
		     frm_remisiones.fecha_desde.value = "";
		     frm_remisiones.fecha_hasta.value = "";
		     break;
		 } 
		case "direccion":
		{
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuremitida').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='visible';
			 document.getElementById('altonivel').style.visibility='visible';
			 document.getElementById('primernivel').style.visibility='visible';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';				
			 frm_remisiones.ano_consulta.disabled = true;
		     frm_remisiones.num_remision.disabled = true;
		     frm_remisiones.num_remitida.disabled = true;
		     frm_remisiones.fecha_desde.disabled = false;
		     frm_remisiones.fecha_hasta.disabled = false;
		     frm_remisiones.alto_nivel.disabled = true;
		     frm_remisiones.direcciones.disabled = false;
		     if (valor2==0)
			 {
		    	frm_remisiones.primer_nivel.disabled = false;
		    	frm_remisiones.direcciones.disabled = true;
		    	frm_remisiones.unidades.disabled = true;
		    	frm_remisiones.primer_nivel.selectedIndex=0;
			 }
		     
             frm_remisiones.primer_nivel.disable = true;
 	     	 frm_remisiones.direcciones.disabled = true;
		     if (valor3==1)
		     {   
		    	 if (valor2!=0)
		    	 {
		    		 frm_remisiones.unidades.disabled = false;//comentado prueba
		    		 
		    	 }
		    	 else
		    	 {
		    		 
		    		 frm_remisiones.unidades.disabled = true;//comentado prueba
		    		// frm_remisiones.check_todos.disabled = true;
		    	 } 
		    	 
		    	 frm_remisiones.todos.disabled = false;
		    	 
		     }
		     if (valor3==2)
		     {
		    	 frm_remisiones.unidades.disabled = true;
		    	 frm_remisiones.todos.disabled = true;
		    	 frm_remisiones.coordinaciones.disabled = false;
		     }
		     if (valor3==3)
		     {
		    	 frm_remisiones.unidades.disabled = true;
		    	 frm_remisiones.todos.disabled = true;
		    	 frm_remisiones.coordinaciones.disabled = true;
		     }

		     frm_remisiones.tmp_valor.value = valor1;
		     frm_remisiones.ano_consulta.value = "";
		     frm_remisiones.num_remision.value = "";
		     frm_remisiones.num_remitida.value = "";
		     frm_remisiones.fecha_desde.value = "";
		     frm_remisiones.fecha_hasta.value = "";
		     break;
		 }
	}//fin de switch

}
function solo_num(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8)return true;
	if(tecla_codigo==0)return true;
	patron =/[0-9 ]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}