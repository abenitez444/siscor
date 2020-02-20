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
function valida(obj){

frm=obj.form;

    if (vacio(frm.nb_alto_nivel.value)==false) {
               alert("Debe Indicar el Nombre del Alto Nivel");
               frm.nb_alto_nivel.focus(); 
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



