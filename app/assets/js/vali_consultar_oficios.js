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
function valida(obj) {
	
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
	
	case "num_correlativo": 
		 {
			 if (vacio(frm.ano_consulta.value)==false)
			 {
			    alert("Debe Indicar el A\u00f1o de la Consulta");
			    frm.ano_consulta.focus();
			    return false
			 }
			 if (vacio(frm.num_correlativo.value)==false)
			 {
			    alert("Debe Indicar el N\u00famero de Correlativo");
			    frm.num_correlativo.focus();
			    return false
			 }
			 
		     
		 break;		
		 } 
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
			    alert("Debe Indicar el N\u00famero de Remisi\u00f3n");
			    frm.num_remision.focus();
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
		case "destinatarios":
		{
			
			if (vacio(frm.destinatario.value)==false)
			{
			    alert("Debe Indicar el Nombre del Destinatario");
			    frm.destinatario.focus();
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
		     break;
		 }

	}
return true 
}
}

function activa_opcion(valor,altonivel)
{
	var fecha_actual = new Date()

	var anio = fecha_actual.getFullYear() 
	
	switch(valor)
	{
		 case "num_correlativo": 
		 {
			 document.getElementById('anioconsulta').style.visibility='visible';
			 document.getElementById('nucorrelativo').style.visibility='visible';
			 document.getElementById('nuremision').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('destinatario').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';
			 frm_oficios.ano_consulta.disabled = false;
			 frm_oficios.ano_consulta.value = anio;
		     frm_oficios.num_correlativo.disabled = false;
		     frm_oficios.num_remision.disabled = true;
		     frm_oficios.fecha_desde.disabled = true;
		     frm_oficios.fecha_hasta.disabled = true;
		     frm_oficios.destinatario.disabled = true;
		     frm_oficios.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_oficios.alto_nivel.selectedIndex = 0;
		     }		     
		     frm_oficios.primer_nivel.disabled = true;
		     frm_oficios.primer_nivel.selectedIndex = 0;
		     frm_oficios.direcciones.disabled = true;
		     frm_oficios.direcciones.selectedIndex = 0;
		     frm_oficios.tmp_valor.value = valor;
		     
		     frm_oficios.num_correlativo.value = "";
		     frm_oficios.num_remision.value = "";
		     frm_oficios.fecha_desde.value = "";
		     frm_oficios.fecha_hasta.value = "";
		     frm_oficios.destinatario.value = "";
	     break;		
		 } 
		 case "num_remision": 
		 {
			 document.getElementById('anioconsulta').style.visibility='visible';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuremision').style.visibility='visible';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('destinatario').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';
			 frm_oficios.ano_consulta.disabled = false;
			 frm_oficios.ano_consulta.value = anio;
		     frm_oficios.num_correlativo.disabled = true;
		     frm_oficios.num_remision.disabled = false;
		     frm_oficios.fecha_desde.disabled = true;
		     frm_oficios.fecha_hasta.disabled = true;
		     frm_oficios.destinatario.disabled = true;
		     frm_oficios.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_oficios.alto_nivel.selectedIndex = 0;
		     }	
		     frm_oficios.primer_nivel.disabled = true;
		     frm_oficios.primer_nivel.selectedIndex = 0;
		     frm_oficios.direcciones.disabled = true;
		     frm_oficios.direcciones.selectedIndex = 0;
		     frm_oficios.tmp_valor.value = valor;
		    
		     frm_oficios.num_remision.value = "";
		     frm_oficios.fecha_desde.value = "";
		     frm_oficios.fecha_hasta.value = "";
		     frm_oficios.destinatario.value = "";
		break;
		} 
		case "fecha":
		{
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuremision').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='visible';
			 document.getElementById('destinatario').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';
			 frm_oficios.ano_consulta.disabled = true;
		     frm_oficios.num_correlativo.disabled = true;
		     frm_oficios.num_remision.disabled = true;
		     frm_oficios.fecha_desde.disabled = false;
		     frm_oficios.fecha_hasta.disabled = false;
		     frm_oficios.destinatario.disabled = true;
		     frm_oficios.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_oficios.alto_nivel.selectedIndex = 0;
		     }	
		     frm_oficios.primer_nivel.disabled = true;
		     frm_oficios.primer_nivel.selectedIndex = 0;
		     frm_oficios.direcciones.disabled = true;
		     frm_oficios.direcciones.selectedIndex = 0;
		     frm_oficios.tmp_valor.value = valor;
		     frm_oficios.ano_consulta.value = "";
		     frm_oficios.num_correlativo.value = "";
		     frm_oficios.num_remision.value = "";
		     frm_oficios.fecha_desde.value = "";
		     frm_oficios.fecha_hasta.value = "";
		     frm_oficios.destinatario.value = "";
	     break;
		 } 
		case "destinatarios":
		{ 
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuremision').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('destinatario').style.visibility='visible';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';
			 frm_oficios.ano_consulta.disabled = true;
		     frm_oficios.num_correlativo.disabled = true;
		     frm_oficios.num_remision.disabled = true;
		     frm_oficios.fecha_desde.disabled = true;
		     frm_oficios.fecha_hasta.disabled = true;
		     frm_oficios.destinatario.disabled = false;
		     frm_oficios.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_oficios.alto_nivel.selectedIndex = 0;
		     }	
		     frm_oficios.primer_nivel.disabled = true;
		     frm_oficios.primer_nivel.selectedIndex = 0;
		     frm_oficios.direcciones.disabled = true;
		     frm_oficios.direcciones.selectedIndex = 0;
		     frm_oficios.tmp_valor.value = valor;
		     frm_oficios.ano_consulta.value = "";
		     frm_oficios.num_correlativo.value = "";
		     frm_oficios.num_remision.value = "";
		     frm_oficios.fecha_desde.value = "";
		     frm_oficios.fecha_hasta.value = "";
		     frm_oficios.destinatario.value = "";
	     break;
		 }		

		case "direccion":
		{
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuremision').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('destinatario').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='visible';
			 document.getElementById('primernivel').style.visibility='visible';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';
			 frm_oficios.ano_consulta.disabled = true;
		     frm_oficios.num_correlativo.disabled = true;
		     frm_oficios.num_remision.disabled = true;
		     frm_oficios.fecha_desde.disabled = true;
		     frm_oficios.fecha_hasta.disabled = true;
		     frm_oficios.destinatario.disabled = true;
		     if (altonivel>=25)
		     {
		    	 frm_oficios.alto_nivel.disabled = true;
		    	 frm_oficios.primer_nivel.disabled = false;
		     }
		     else
		     {
			     frm_oficios.alto_nivel.disabled = false;
			     frm_oficios.primer_nivel.disabled = true;
		     }		     

		     frm_oficios.direcciones.disabled = true;
		     frm_oficios.tmp_valor.value = valor;
		     frm_oficios.ano_consulta.value = "";
		     frm_oficios.num_correlativo.value = "";
		     frm_oficios.num_remision.value = "";
		     frm_oficios.fecha_desde.value = "";
		     frm_oficios.fecha_hasta.value = "";
		     frm_oficios.destinatario.value = "";
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