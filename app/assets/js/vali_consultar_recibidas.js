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
		 case "num_externo": 
		 {
			 if (vacio(frm.ano_consulta.value)==false)
			 {
			    alert("Debe Indicar el A\u00f1o de la Consulta");
			    frm.ano_consulta.focus();
			    return false
			 }			 
			 if (vacio(frm.num_externo.value)==false)
			 {
			    alert("Debe Indicar el N\u00famero Externo");
			    frm.num_externo.focus();
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
		case "remitente":
		{
			if (vacio(frm.remitente.value)==false)
			{
			    alert("Debe Indicar el Nombre del Remitente");
			    frm.remitente.focus();
				return false
			}
		    break;
		 }		
		case "cedula":
		{
			 if (vacio(frm.ced_remitente.value)==false)
			 {
			    alert("Debe Indicar el N\u00famero Externo");
			    frm.ced_remitente.focus();
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
			if ((frm.primer_nivel.selectedIndex)==0)
			{
			   alert("Debe Seleccionar el Primer Nivel"); 
			   frm.primer_nivel.focus();
			   return false
			}
		     break;
		 }
		case "documentos":
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
			if (frm.clasificacion_documentos.selectedIndex==0)
			{
			   alert("Debe Seleccionar la Clasificaci\u00f3n del Documento"); 
			   frm.clasificacion_documentos.focus();
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
			 document.getElementById('nuexterno').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('remitente').style.visibility='hidden';
			 document.getElementById('cedula').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('documento').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';				
			 frm_recibidas.ano_consulta.disabled = false;
			 frm_recibidas.ano_consulta.value = anio;
		     frm_recibidas.num_correlativo.disabled = false;
		     frm_recibidas.num_externo.disabled = true;
		     frm_recibidas.fecha_desde.disabled = true;
		     frm_recibidas.fecha_hasta.disabled = true;
		     frm_recibidas.remitente.disabled = true;
		     frm_recibidas.ced_remitente.disabled = true;
		     frm_recibidas.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_recibidas.alto_nivel.selectedIndex = 0;
		     }		     
		     frm_recibidas.primer_nivel.disabled = true;
		     frm_recibidas.primer_nivel.selectedIndex = 0;
		     frm_recibidas.direcciones.disabled = true;
		     frm_recibidas.direcciones.selectedIndex = 0;
		     frm_recibidas.clasificacion_documentos.disabled = true;
		     frm_recibidas.tmp_valor.value = valor;
		     frm_recibidas.num_correlativo.value = "";
		     frm_recibidas.num_externo.value = "";
		     frm_recibidas.fecha_desde.value = "";
		     frm_recibidas.fecha_hasta.value = "";
		     frm_recibidas.remitente.value = "";
		     frm_recibidas.ced_remitente.value = "";
		     frm_recibidas.clasificacion_documentos.selectedIndex = 0;
		 break;		
		 } 
		 case "num_externo": 
		 {
			 document.getElementById('anioconsulta').style.visibility='visible';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuexterno').style.visibility='visible';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('remitente').style.visibility='hidden';
			 document.getElementById('cedula').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('documento').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';			 
			 frm_recibidas.ano_consulta.disabled = false;
			 frm_recibidas.ano_consulta.value = anio;
		     frm_recibidas.num_correlativo.disabled = true;
		     frm_recibidas.num_externo.disabled = false;
		     frm_recibidas.num_externo.value = "S/N";
		     frm_recibidas.fecha_desde.disabled = true;
		     frm_recibidas.fecha_hasta.disabled = true;
		     frm_recibidas.remitente.disabled = true;
		     frm_recibidas.ced_remitente.disabled = true;
		     frm_recibidas.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_recibidas.alto_nivel.selectedIndex = 0;
		     }
		     frm_recibidas.primer_nivel.disabled = true;
		     frm_recibidas.primer_nivel.selectedIndex = 0;
		     frm_recibidas.direcciones.disabled = true;
		     frm_recibidas.direcciones.selectedIndex = 0;
		     frm_recibidas.clasificacion_documentos.disabled = true;
		     frm_recibidas.tmp_valor.value = valor;
		     frm_recibidas.num_correlativo.value = "";
		     frm_recibidas.fecha_desde.value = "";
		     frm_recibidas.fecha_hasta.value = "";
		     frm_recibidas.remitente.value = "";
		     frm_recibidas.ced_remitente.value = "";
		     frm_recibidas.clasificacion_documentos.selectedIndex = 0;
		     break;
		} 
		case "fecha":
		{
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuexterno').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='visible';
			 document.getElementById('remitente').style.visibility='hidden';
			 document.getElementById('cedula').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('documento').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';			
			 frm_recibidas.ano_consulta.disabled = true;
		     frm_recibidas.num_correlativo.disabled = true;
		     frm_recibidas.num_externo.disabled = true;
		     frm_recibidas.fecha_desde.disabled = false;
		     frm_recibidas.fecha_hasta.disabled = false;
		     frm_recibidas.remitente.disabled = true;
		     frm_recibidas.ced_remitente.disabled = true;
		     frm_recibidas.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_recibidas.alto_nivel.selectedIndex = 0;
		     }
		     frm_recibidas.primer_nivel.disabled = true;
		     frm_recibidas.primer_nivel.selectedIndex = 0;
		     frm_recibidas.direcciones.disabled = true;
		     frm_recibidas.direcciones.selectedIndex = 0;
		     frm_recibidas.clasificacion_documentos.disabled = true;
		     frm_recibidas.tmp_valor.value = valor;
		     frm_recibidas.ano_consulta.value = "";
		     frm_recibidas.num_correlativo.value = "";
		     frm_recibidas.num_externo.value = "";
		     frm_recibidas.fecha_desde.value = "";
		     frm_recibidas.fecha_hasta.value = "";
		     frm_recibidas.remitente.value = "";
		     frm_recibidas.ced_remitente.value = "";
		     frm_recibidas.clasificacion_documentos.selectedIndex = 0;
		     break;
		 } 
		case "remitente":
		{
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuexterno').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('remitente').style.visibility='visible';
			 document.getElementById('cedula').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('documento').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';				
			 frm_recibidas.ano_consulta.disabled = true;
		     frm_recibidas.num_correlativo.disabled = true;
		     frm_recibidas.num_externo.disabled = true;
		     frm_recibidas.fecha_desde.disabled = true;
		     frm_recibidas.fecha_hasta.disabled = true;
		     frm_recibidas.remitente.disabled = false;
		     frm_recibidas.ced_remitente.disabled = true;
		     frm_recibidas.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_recibidas.alto_nivel.selectedIndex = 0;
		     }
		     frm_recibidas.primer_nivel.disabled = true;
		     frm_recibidas.primer_nivel.selectedIndex = 0;
		     frm_recibidas.direcciones.disabled = true;
		     frm_recibidas.direcciones.selectedIndex = 0;
		     frm_recibidas.clasificacion_documentos.disabled = true;
		     frm_recibidas.tmp_valor.value = valor;
		     frm_recibidas.ano_consulta.value = "";
		     frm_recibidas.num_correlativo.value = "";
		     frm_recibidas.num_externo.value = "";
		     frm_recibidas.fecha_desde.value = "";
		     frm_recibidas.fecha_hasta.value = "";
		     frm_recibidas.remitente.value = "";
		     frm_recibidas.ced_remitente.value = "";
		     frm_recibidas.clasificacion_documentos.selectedIndex = 0;
		     break;
		 }		
		case "cedula":
		{
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuexterno').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('remitente').style.visibility='hidden';
			 document.getElementById('cedula').style.visibility='visible';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('documento').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';			
			 frm_recibidas.ano_consulta.disabled = true;
		     frm_recibidas.num_correlativo.disabled = true;
		     frm_recibidas.num_externo.disabled = true;
		     frm_recibidas.fecha_desde.disabled = true;
		     frm_recibidas.fecha_hasta.disabled = true;
		     frm_recibidas.remitente.disabled = true;
		     frm_recibidas.ced_remitente.disabled = false;
		     frm_recibidas.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_recibidas.alto_nivel.selectedIndex = 0;
		     }
		     frm_recibidas.primer_nivel.disabled = true;
		     frm_recibidas.primer_nivel.selectedIndex = 0;
		     frm_recibidas.direcciones.disabled = true;
		     frm_recibidas.direcciones.selectedIndex = 0;
		     frm_recibidas.clasificacion_documentos.disabled = true;
		     frm_recibidas.tmp_valor.value = valor;
		     frm_recibidas.ano_consulta.value = "";
		     frm_recibidas.num_correlativo.value = "";
		     frm_recibidas.num_externo.value = "";
		     frm_recibidas.fecha_desde.value = "";
		     frm_recibidas.fecha_hasta.value = "";
		     frm_recibidas.remitente.value = "";
		     frm_recibidas.ced_remitente.value = "";
		     frm_recibidas.clasificacion_documentos.selectedIndex = 0;
		     break;
		}
		case "direccion":
		{
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuexterno').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='hidden';
			 document.getElementById('remitente').style.visibility='hidden';
			 document.getElementById('cedula').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='visible';
			 document.getElementById('primernivel').style.visibility='visible';
			 document.getElementById('documento').style.visibility='hidden';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';			
			 frm_recibidas.ano_consulta.disabled = true;
		     frm_recibidas.num_correlativo.disabled = true;
		     frm_recibidas.num_externo.disabled = true;
		     frm_recibidas.fecha_desde.disabled = true;
		     frm_recibidas.fecha_hasta.disabled = true;
		     frm_recibidas.remitente.disabled = true;
		     frm_recibidas.ced_remitente.disabled = true;
		     if (altonivel>=25)
		     {
		    	 frm_recibidas.alto_nivel.disabled = true;
		    	 frm_recibidas.primer_nivel.disabled = false;
		     }
		     else
		     {
		    	 frm_recibidas.alto_nivel.disabled = false;
			     frm_recibidas.primer_nivel.disabled = true;
		     }		     
		     frm_recibidas.direcciones.disabled = true;
		     frm_recibidas.clasificacion_documentos.disabled = true;
		     frm_recibidas.tmp_valor.value = valor;
		     frm_recibidas.ano_consulta.value = "";
		     frm_recibidas.num_correlativo.value = "";
		     frm_recibidas.num_externo.value = "";
		     frm_recibidas.fecha_desde.value = "";
		     frm_recibidas.fecha_hasta.value = "";
		     frm_recibidas.remitente.value = "";
		     frm_recibidas.ced_remitente.value = "";
		     frm_recibidas.clasificacion_documentos.selectedIndex = 0;
		     break;
		 }
		case "documentos":
		 {
			 document.getElementById('anioconsulta').style.visibility='hidden';
			 document.getElementById('nucorrelativo').style.visibility='hidden';
			 document.getElementById('nuexterno').style.visibility='hidden';
			 document.getElementById('fecha').style.visibility='visible';
			 document.getElementById('remitente').style.visibility='hidden';
			 document.getElementById('cedula').style.visibility='hidden';
			 document.getElementById('altonivel').style.visibility='hidden';
			 document.getElementById('primernivel').style.visibility='hidden';
			 document.getElementById('documento').style.visibility='visible';
			 document.getElementById('campos').style.visibility='visible';
			 document.getElementById('campos2').style.visibility='visible';
			 frm_recibidas.ano_consulta.disabled = true;
		     frm_recibidas.num_correlativo.disabled = true;
		     frm_recibidas.num_externo.disabled = true;
		     frm_recibidas.fecha_desde.disabled = false;
		     frm_recibidas.fecha_hasta.disabled = false;
		     frm_recibidas.remitente.disabled = true;
		     frm_recibidas.ced_remitente.disabled = true;
		     frm_recibidas.alto_nivel.disabled = true;
		     if (altonivel<=24)
		 	 {
		    	 frm_recibidas.alto_nivel.selectedIndex = 0;
		     }
		     frm_recibidas.primer_nivel.disabled = true;
		     frm_recibidas.primer_nivel.selectedIndex = 0;
		     frm_recibidas.direcciones.disabled = true;
		     frm_recibidas.direcciones.selectedIndex = 0;
		     frm_recibidas.clasificacion_documentos.disabled = false;
		     frm_recibidas.tmp_valor.value = valor;
		     frm_recibidas.ano_consulta.value = "";
		     frm_recibidas.num_correlativo.value = "";
		     frm_recibidas.num_externo.value = "";
		     frm_recibidas.fecha_desde.value = "";
		     frm_recibidas.fecha_hasta.value = "";
		     frm_recibidas.remitente.value = "";
		     frm_recibidas.ced_remitente.value = "";
		     frm_recibidas.clasificacion_documentos.selectedIndex = 0;
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
function limpiar(v) {
	
	frm=v.form;

     if ( frm.num_externo.value== "S/N"  ) {
    	 frm.num_externo.value="";
          }
     else{
    	 frm.num_externo.value=frm.num_externo.value;

     }
}