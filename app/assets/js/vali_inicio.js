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
	 if (vacio(frm.usuario.value)==false) {
               alert("Debe Indicar el nombre de Usuario");
               frm.usuario.focus(); 
	       return false
	}
	if (vacio(frm.password.value)==false) {
               alert("Debe Indicar la Contrase\u00f1a");
               frm.password.focus();
	       return false
	}
    if (vacio(frm.tmptxt.value)==false) {
               alert("Debe Indicar los Caracteres de la Imagen");
               frm.tmptxt.focus();
	       return false
        }
	
return true       
}
function solo_num_newusuario(e){
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8)return true;
	if(tecla_codigo==0)return true;
	patron =/[0-9 ]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}






