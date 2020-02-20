$(document).ready( function() {

			//BASIC
			/*$(".pass_nuevo").passStrength({
				userid:	"#user_id"
				});*/
			
			//ADVANCED
			$(".pass_nuevo").passStrength({
				shortPass: 		"top_shortPass",
				badPass:		"top_badPass",
				goodPass:		"top_goodPass",
				strongPass:		"top_strongPass",
				baseStyle:		"top_testresult",
				userid:			"#user_id_adv",
				messageloc:		0
			});
		});
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
function valida(obj) 
{
	frm=obj.form;
	if (vacio(frm.pass_actual.value)==false)
	{
	    alert("Ingrese la Contrase\u00f1a Actual");
	    frm.pass_actual.focus();
	    return false
	}
	if (vacio(frm.pass_nuevo.value)==false)
	{
	    alert("Ingrese la Contrase\u00f1a Nueva");
	    frm.pass_nuevo.focus();
	    return false
	}
	if (frm.pass_nuevo.value.length<6) 
	{
		 alert("La Contrase\u00f1a no debe ser menor a 6 d\u00edgitos");
        frm.pass_nuevo.focus();
        return false
 	}
	if (vacio(frm.pass_confir.value)==false)
	{
	    alert("Ingrese la Confirmaci\u00f3n de la Contrase\u00f1a Nueva");
	    frm.pass_confir.focus();
	    return false
	}
	if ((frm.pass_nuevo.value)!=(frm.pass_confir.value))
	{
		 alert("La Contrase\u00f1a Nueva y La Confirmaci\u00f3n de la Contrase\u00f1a deben ser Iguales");
	     frm.pass_nuevo.focus();
	     return false
	}
	if (vacio(frm.tmptxt.value)==false)
	{
        alert("Debe Indicar los Caracteres de la Imagen");
        frm.tmptxt.focus();
        return false
    }
	 	
return true       
}