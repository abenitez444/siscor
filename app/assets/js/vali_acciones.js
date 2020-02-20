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

    if (vacio(frm.nb_acciones.value)==false) {
               alert("Debe Indicar el Nombre de la Acci\u00f3n");
               frm.nb_acciones.focus(); 
	       return false
	}

	

return true       
}

function confirma() { 

    if(confirm(" ¿Desea eliminar el registro? ")) {return true;} 

       else {
        return false;

      }   

}



