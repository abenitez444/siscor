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


if (frm.habi_user.checked!=true && frm.habi_tipo_user.checked!=true && frm.habi_alto_nivel.checked!=true && frm.habi_perfiles.checked!=true && frm.habi.checked!=true)  {
	   alert("Debe Indicar al menos una opci\u00f3n para realizar la Consulta de Usuarios");
	   return false
	}



if (frm.habi_user.checked !=false){
	 if (vacio(frm.nb_usuarios.value)==false) {
         alert("Debe Indicar el Nombre del Usuario");
         frm.nb_usuarios.focus(); 
     return false
	 }
}

if (frm.habi_tipo_user.checked !=false){
	if ((frm.tipo_usuario.selectedIndex)==0) {
        alert("Debe Seleccionar el Tipo de Usuario"); 
        frm.tipo_usuario.focus();
    return false
	}
}

if (frm.habi_alto_nivel.checked !=false){
	if (frm.alto_nivel.selectedIndex==0) {
		alert("Debe Seleccionar el Alto Nivel"); 
		frm.alto_nivel.focus();
		return false
	}
}
	 
if (frm.habi_perfiles.checked !=false){
	if (frm.perfiles.selectedIndex==0) {
		alert("Debe Seleccionar el Perfil"); 
		frm.perfiles.focus();
		return false
		}
}

return true       
}
//valida solo letras
//Funcion que valida que solo ingrese letras 
function validarletra(a) { 
  tecla = (document.all) ? a.keyCode : a.which;
	if (tecla==0) return true; //Tecla que permite las flechas de direccionamiento,tab,supr
	if (tecla==8) return true; //Tecla de retroceso (para poder borrar)  
	if (tecla==32) return true; //Tecla de espacio (para poder borrar) 
	if (tecla==47) return true; //Tecla / 
	if (tecla==40) return true; //Tecla ( 
	if (tecla==41) return true; //Tecla )
	if (tecla==95) return true; //Tecla _
	if (tecla==61) return false; //Tecla =
	if (tecla==241) return true;// Tacla para la letra ñ
	if (tecla==209) return true;// Tacla para la letra Ñ
	if (tecla==225) return true;//Tecla para el acento de la letra a 
	if (tecla==233) return true;//Tecla para el acento de la letra e
	if (tecla==237) return true;//Tecla para el acento de la letra i 
	if (tecla==243) return true;//Tecla para el acento de la letra o 
	if (tecla==250) return true;//Tecla para el acento de la letra u 
	if (tecla==193) return true;//Tecla para el acento de la letra A 
	if (tecla==201) return true;//Tecla para el acento de la letra E
	if (tecla==205) return true;//Tecla para el acento de la letra I 
	if (tecla==211) return true;//Tecla para el acento de la letra O 
	if (tecla==218) return true;//Tecla para el acento de la letra U
	if (tecla==250) return true;//Tecla para el acento de la letra u 
	patron =/[A-Za-z]/; // Solo acepta letras 
	//if (key >= 48 && key <= 57) return true;
	//patron = /\d/; Solo acepta n�meros 
  //patron = /\w/; Acepta n�meros y letras 
  //patron = /\D/; //No acepta n�meros 
  te = String.fromCharCode(tecla); 
  return patron.test(te);  
} // fin de la funcion de solo letras

//valida solo letras
//Funcion que valida que solo ingrese letras 
function validarletra(a) { 
  tecla = (document.all) ? a.keyCode : a.which;
	if (tecla==0) return true; //Tecla que permite las flechas de direccionamiento,tab,supr
	if (tecla==8) return true; //Tecla de retroceso (para poder borrar)  
	if (tecla==32) return true; //Tecla de espacio (para poder borrar) 
	if (tecla==47) return true; //Tecla / 
	if (tecla==40) return true; //Tecla ( 
	if (tecla==41) return true; //Tecla )
	if (tecla==95) return true; //Tecla _
	if (tecla==61) return false; //Tecla =
	if (tecla==241) return true;// Tacla para la letra ñ
	if (tecla==209) return true;// Tacla para la letra Ñ
	if (tecla==225) return true;//Tecla para el acento de la letra a 
	if (tecla==233) return true;//Tecla para el acento de la letra e
	if (tecla==237) return true;//Tecla para el acento de la letra i 
	if (tecla==243) return true;//Tecla para el acento de la letra o 
	if (tecla==250) return true;//Tecla para el acento de la letra u 
	if (tecla==193) return true;//Tecla para el acento de la letra A 
	if (tecla==201) return true;//Tecla para el acento de la letra E
	if (tecla==205) return true;//Tecla para el acento de la letra I 
	if (tecla==211) return true;//Tecla para el acento de la letra O 
	if (tecla==218) return true;//Tecla para el acento de la letra U
	if (tecla==250) return true;//Tecla para el acento de la letra u 
	patron =/[A-Za-z]/; // Solo acepta letras 
	//if (key >= 48 && key <= 57) return true;
	//patron = /\d/; Solo acepta n�meros 
  //patron = /\w/; Acepta n�meros y letras 
  //patron = /\D/; //No acepta n�meros 
  te = String.fromCharCode(tecla); 
  return patron.test(te);  
} // fin de la funcion de solo letras