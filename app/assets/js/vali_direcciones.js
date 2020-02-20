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
	if (frm.alto_nivel.selectedIndex==0) {
		   alert("Debe Seleccionar el Alto Nivel"); 
		   frm.alto_nivel.focus();
	   return false
	}

	if (frm.primer_nivel.selectedIndex==0) {
		   alert("Debe Seleccionar el Primer Nivel"); 
		   frm.primer_nivel.focus();
	   return false
	}
	
	
    if (vacio(frm.nb_direcciones.value)==false) {
        alert("Debe Indicar el Nombre de la Direcci\u00f3n");
        frm.nb_direcciones.focus(); 
    return false
}
	
	return true
}


/* Funcion que permite solo numeros*/
function solo_num(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8)return true;
	if(tecla_codigo==0)return true;
	patron =/[0-9 .,]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}

function confirma() { 

    if(confirm(" ¿Desea eliminar el registro? ")) {return true;} 

       else {
        return false;

      }   

}