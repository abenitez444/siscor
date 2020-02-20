//busca caracteres que no sean espacio en blanco en una cadena
function vacio(q)
{
	for ( i = 0; i < q.length; i++ )
	{
		if ( q.charAt(i) != " "  )
		{
			return true
        }
    }
    return false
}

//valida que el campo no este vacio y no tenga solo espacios en blanco
function valida(obj)
{
    frm=obj.form;
	
    if (vacio(frm.nb_entes_externos.value)==false)
    {
        alert("Debe Indicar el Nombre del Ente Externo");
        frm.nb_entes_externos.focus(); 
    return false
    }
	return true
}

/* Funcion que permite solo numeros*/
function solo_num(e)
{
	tecla_codigo = (document.all) ? e.keyCode : e.which;
	if(tecla_codigo==8)return true;
	if(tecla_codigo==0)return true;
	patron =/[0-9 .,]/;
	tecla_valor = String.fromCharCode(tecla_codigo);
	return patron.test(tecla_valor);
}

function confirma() 
{ 
    if(confirm(" ¿Desea eliminar el registro? ")) 
    {
    	return true;
    } 
    else
    {
        return false;
    }   
}