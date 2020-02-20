/*
'*********************************************************************
'*** /js/jvstoos.asp
'*** Funciones JavaScripts
'*** Created by: Papa
'*********************************************************************
*/


// ******************************* Popup Functions **********************************


function popup(url, w, h) {

  var int_windowLeft = (screen.width - w) / 2;
  var int_windowTop = (screen.height - h) / 2;

	popupwin = window.open( "", "xshow", "toolbar=no,location=no,directories=no,status=no,menubar=no,width="+ w +",height=" + h + ",top=" + int_windowTop + ",left=" + int_windowLeft + ",resizable=0,scrollbars=1" );
	popupwin.location = url;
	popupwin.focus();
}


function fullpopup(url) {


	popupwin = window.open( "", "xshow", "toolbar=no,location=no,directories=no,status=no,menubar=no,width="+ (screen.availWidth - 10) +",height=" + (screen.availHeight -15) + ",top=0,left=0,resizable=1,scrollbars=1" );
	popupwin.location = url;
	popupwin.focus();
}





//------------------------------------------------------------------------------------

function showcolor(ctr, oldcolor) {

	var newcolor = showModalDialog("/js/select_color.html", oldcolor, "resizable: no; help: no; status: no; scroll: no;");
	if (newcolor != null) {
		ctr.value = "#" + newcolor;
		ctr.style.backgroundColor = "#" + newcolor;
	}
}


// ******************************* List Functions **********************************

function swapList (l2,l1) {

	var texto,value, list1, list2, x, y;
	var optsnew1, txttmp, valtmp;

	list1 = l1;
	list2 = l2;

	if (list2.selectedIndex == -1) return;
	texto = list2.options[list2.selectedIndex].text;
	value = list2.options[list2.selectedIndex].value;

	if (value == "") return;

	y = 0;
	optsnew1 = new Array;
	for (x = 0; x < list2.length; x++) {
		if (list2.options[x].text != texto || list2.options[x].value != value) {
			txttmp = list2.options[x].text;
			valtmp = list2.options[x].value;
			list2.options[y].value = valtmp;
			list2.options[y].text = txttmp;
			y++;
		}
	}
	list2.options[list2.options.length - 1] = null;

	y = list1.options.length;
	list1.options[y] = new Option;
	list1.options[y].text = texto;
	list1.options[y].value = value;
}

//------------------------------------------------------------------------------------

function swapListall (l2,l1) {

	var texto,value, list1, list2, x, y;
	var optsnew1, txttmp, valtmp, inicio;

	list1 = l1;
	list2 = l2;

	if (list2.length == 0) return;

	optsnew1 = new Array;

	if (list1.length!=0)
	 {
		inicio=list1.length;
		y = inicio;
		list1.length=list2.length + inicio;
	 }
	else
	 {
		y=0
		list1.length=list2.length
	 }


	for (x = 0; x < list2.length; x++) {
		if (list2.options[x].text != texto) {
			txttmp = list2.options[x].text;
			valtmp = list2.options[x].value;
			list1.options[y] = new Option
			list1.options[y].value = valtmp;
			list1.options[y].text = txttmp;
			y++;
		}
	}

	list2.length=0;
}

//------------------------------------------------------------------------------------

function AddItemList (l1,value) {

	if (value == "") return;

	var texto, list1, y;

	list1 = l1;

	y = list1.options.length;
	list1.options[y] = new Option;
	list1.options[y].text = value;
	list1.options[y].value = value;
}

//------------------------------------------------------------------------------------

	function ResetList(Obj, valuesArray, actualValue){

		for ( idex in valuesArray ) {
			if(idex != "arrayIndex"){
				properties = valuesArray[idex].split('%');

				Obj.options[idex] = new Option;

				Obj.options[idex].text = properties[1];
				Obj.options[idex].value = properties[0];
				Obj.options[idex].selected = (properties[0] == actualValue ? true : false);
			}
		}
	}

//------------------------------------------------------------------------------------

	function ClearList(Obj){
		Obj.options.length = 0;
	}

//------------------------------------------------------------------------------------


function SelItemList(lista){

	for (i=0;i<lista.length;i++)
		{lista.options[i].selected = true;}

	return (true);
}

//------------------------------------------------------------------------------------

function SumArrayObjects(Obj){
	var total = 0;

	montos = Obj;
	if (!isUndefined(montos)){
		if (isUndefined(montos.length)){
			valor = Number(montos.value);
			total = total + valor;
		}
		else
		{
			for (i = 0; i<montos.length; ++ i){
				if (!isNaN(montos[i].value)){
					valor = Number(montos[i].value);
					total = total + valor;
				}
			}
		}
	}

	return total;
}

//------------------------------------------------------------------------------------

function SumProductoArrayObjects(cantidades, montos){
	var total = 0;

	if (!isUndefined(montos)){
		if (isUndefined(montos.length)){
			valor = Number(montos.value) * Number(cantidades.value);
			total = total + valor;
		}
		else
		{
			for (i = 0; i<montos.length; ++ i){
				if (!isNaN(montos[i].value)){
					valor = Number(montos[i].value) * Number(cantidades[i].value) ;
					total = total + valor;
				}
			}
		}
	}

	return total;
}

//------------------------------------------------------------------------------------

function CheckArrayObjectsUnique(lista){

	for (i = 0; i< lista.length; ++ i){
		if (lista[i].value!=""){
			for (j = i + 1; j< lista.length; ++ j){
				if (lista[j].value!=""){
					if (lista[i].value == lista[j].value){
						return false;
					}
				}
			}
		}
	}

	return true;
}

//------------------------------------------------------------------------------------

function CheckArrayObjectsSelAny(lista){
	for (i = 0; i< lista.length; ++ i){
		if (lista[i].value!=""){
			return true;

		}
	}
	return false;
}

//------------------------------------------------------------------------------------

function DisableList(lista, value){

	for (i = 0; i< lista.length; ++ i){
		lista[i].disabled = value
	}
	return true;
}


// ******************************* Html - Format Functions **********************************

function ShowItem(iditem) {
	iditem.style.display = (iditem.style.display == "none" ) ? "" : "none";
}

//------------------------------------------------------------------------------------

function ChangeLabel(idItem, texto) {
	idItem.innerHTML = texto;
}

//------------------------------------------------------------------------------------

function formatCurrency(num) {
	num = num.toString().replace(/\$|\,/g,'');

	if(isNaN(num)) 	num = "0";

	sign = (num == (num = Math.abs(num)));

	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10) cents = "0" + cents;

	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++){
		num = num.substring(0,num.length-(4*i+3))+','+ num.substring(num.length-(4*i+3));
	}

	return (((sign)?'':'-') + num + '.' + cents);
}

//------------------------------------------------------------------------------------

function formatLong(num) {
	num = num.toString().replace(/\$|\,/g,'');

	if(isNaN(num)) 	num = "0";

	sign = (num == (num = Math.abs(num)));

	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10) cents = "0" + cents;

	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++){
		num = num.substring(0,num.length-(4*i+3))+','+ num.substring(num.length-(4*i+3));
	}

	return (((sign)?'':'-') + num);
}

//------------------------------------------------------------------------------------

function ValidateNumber(Obj, mensaje) {
	var num = Obj.value
	num = num.toString().replace(/\$|\,/g,'');

	if(isNaN(num)){
		num = "0";
		Obj.value = 0;
	}

	if(num == ""){
		num = "error";
		Obj.value = 0;
	}

	num = Number(num);

	if (num < 0){
		alert(mensaje);
		Obj.focus();
	}
	return (num >= 0);
}


//------------------------------------------------------------------------------------

function GetNumber(Obj) {
	var num = Obj.value
	num = num.toString().replace(/\$/g,'');
	num = num.toString().replace(/\,/g,'.');

	if(isNaN(num)){
		num = "0";
		Obj.value = 0;
	} else {
		if (Obj.value != num){
			Obj.value = num;
		}
	}
	return Number(num);
}

//------------------------------------------------------------------------------------

function GetNumberValue(Obj) {
	var num = Obj.value
	num = num.toString().replace(/\$|\,/g,'');

	if(isNaN(num)){
		num = "0";
	}
	return Number(num);
}


//------------------------------------------------------------------------------------

function isUndefined(item) {
	return (typeof item == 'undefined');
}

//------------------------------------------------------------------------------------

function PromptMessage (Ctrl, PromptStr) {
	alert (PromptStr)
	Ctrl.focus();
	return;
}

//------------------------------------------------------------------------------------

function Left(str, n){
	if (n <= 0)
	    return "";
	else if (n > String(str).length)
	    return str;
	else
	    return String(str).substring(0,n);
}

//------------------------------------------------------------------------------------

function Right(str, n){
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
}

//-----Type only numbers in a field-----------------------------------------------------
function filterKey(keyEvent,input_type) {
	if ( ! keyEvent ) {
		var keyEvent = window.event;
	}
	if ( keyEvent.target ) {
		firingElement = keyEvent.target;
	} else if ( keyEvent.srcElement ) {
		firingElement = keyEvent.srcElement;
	}
	if(input_type == "number"){

		if ( isKeyNumber(keyEvent.keyCode) ) {
			return true;
		} else {
			return false;
		}
	}
}

function isKeyNumber(keyToTest) {
	okayKeys = Array(9, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 9);
	for ( var ii in okayKeys ) {
		if ( okayKeys[ii] == keyToTest )
		return true;
	}
		return false;
}

//-----Type only numbers in a field-----------------------------------------------------
function filterKeyCedula(keyEvent,input_type) {
	if ( ! keyEvent ) {
		var keyEvent = window.event;
	}
	if ( keyEvent.target ) {
		firingElement = keyEvent.target;
	} else if ( keyEvent.srcElement ) {
		firingElement = keyEvent.srcElement;
	}
	if(input_type == "number"){

		if ( isKeyNumberCedula(keyEvent.keyCode) ) {
			return true;
		} else {
			return false;
		}
	}
}

function isKeyNumberCedula(keyToTest) {
	okayKeys = Array(9, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 8, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 109);
	for ( var ii in okayKeys ) {
		if ( okayKeys[ii] == keyToTest )
		return true;
	}
		return false;
}

//------------------------------------------------------------------------------------

function getObj(name) {
	if (document.getElementById) {
		return document.getElementById(name);
	} else if (document.all) {
		return document.all[name];
	} else if (document.layers) {
		return document.layers[name];
	}
}

//------------------------------------------------------------------------------------

function getObjParent(name) {
	if (opener.document.getElementById) {
		return opener.document.getElementById(name);
	} else if (opener.document.all) {
		return opener.document.all[name];
	} else if (opener.document.layers) {
		return opener.document.layers[name];
	}
}

//------------------------------------------------------------------------------------

function Trim(valor){

	if(valor.length < 1){
		return"";
	}

	valor = RTrim(valor);
	valor = LTrim(valor);

	if(valor == ""){
		return "";
	}
	else{
		return valor;
	}
}

//------------------------------------------------------------------------------------

function ValidateMonth(Obj, mensaje) {
	var num = Obj.value
	num = num.toString().replace(/\$|\,/g,'');

	if(isNaN(num)){
		num = "0";
		Obj.value = 0;
	}

	num = Number(num);

	if (num < 0 || num > 12){
		alert(mensaje);
		Obj.focus();
		return false;
	}
	return true;
}

//------------------------------------------------------------------------------------

function sz(t) {
		a = t.value.split('\n');
		b=1;
		for (x=0;x < a.length; x++) {
		 if (a[x].length >= t.cols) b+= Math.floor(a[x].length/t.cols);
		 }
		b+= a.length;
		if (b > t.rows) t.rows = b;
}

// ******************************* Date Functions **********************************

var dtCh= "/";
var minYear=1900;
var maxYear=2100;

//------------------------------------------------------------------------------------

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    return true;
}

//------------------------------------------------------------------------------------

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    for (i = 0; i < s.length; i++){
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

//------------------------------------------------------------------------------------

function daysInFebruary (year){
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}

//------------------------------------------------------------------------------------

function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   }
   return this
}

//------------------------------------------------------------------------------------

function isDate(dtStr, label){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strMonth=dtStr.substring(0,pos1)
	var strDay=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("Formato de la Fecha en '"+ label + "' es Inv�lida")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("En el campo '"+ label + "' el mes es Inv�lido")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("En el campo '"+ label + "' el dia es Inv�lido")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Introduzca un a�o valido de 4 digitos entre "+minYear+" y "+maxYear + " en el campo '" + label + "'")
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Fecha Invalida en el campo '"+ label + "'")
		return false
	}
return true
}

// ******************************* AJAX Functions **********************************

	function createHttp(){
		var http = null;

		try {
			http = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e1) {
			try {
				http = new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e2) {
					http = null;
				}
			}

		if (!http) {
			if (typeof XMLHttpRequest != "undefined") {
				http = new XMLHttpRequest();
			} else {
				http = null;
			}
		}
		return http;
	}

//------------------------------------------------------------------------------------

	function GETHttp(address){
	  http = createHttp();
	  http.open('GET', address, false);
	  http.send(null);

   	return http.responseText;
	}

//------------------------------------------------------------------------------------


//------------------------------------------------------------------------------------
  function checkFieldType(theInput, fieldType) {
    var knownTypes = {'digits'            : [/^\d*$/, '234530'],
                      'requiredDigits'    : [/^\d+$/, '234530'],
                      'decimales'         : [/^(\d*)(\.?)(\d*)$/, '234530.87'],
                      'requiredDecimales' : [/^(\d+)(\.\d*)?$/, '234530.87'],
                      'letras'            : [/^[a-zA-Z������������ ]*$/, 'Karen Nu�oz'],
                      'telefono'          : [/^[\d-]*$/, '339-3406'],
                      'all'               : [/.*/, '']}
    var trialValue = theInput.value;
    var pattern = knownTypes[fieldType] ? knownTypes[fieldType] : knownTypes['all'];
    var isTrialOkay = pattern[0].test(trialValue);
    if ( ! theInput.ejemploContainer ) {
      theInput.ejemploContainer = document.createElement('span');
      theInput.parentNode.appendChild(theInput.ejemploContainer);
      theInput.ejemploContainer.appendChild(document.createTextNode('Ejemplo : ' + pattern[1]));
      theInput.ejemploContainer.style.display = 'none';
      theInput.ejemploContainer.style.fontFamily = 'Verdana';
      theInput.ejemploContainer.style.fontSize = '8pt';
      theInput.ejemploContainer.style.position = 'absolute';
      theInput.ejemploContainer.style.left = (fullOffsetLeft(theInput) + theInput.offsetWidth) + 'px';
      theInput.ejemploContainer.style.top = (fullOffsetTop(theInput) - 6) + 'px';
      theInput.ejemploContainer.style.zIndex = 10;
      theInput.ejemploContainer.style.width = 200 + 'px';
      theInput.ejemploContainer.style.border = 'thin inset black';
      theInput.ejemploContainer.style.padding = '6px';
      theInput.ejemploContainer.style.color = 'red';
      theInput.ejemploContainer.style.backgroundColor = 'white';

    }
    if ( isTrialOkay ) {
      theInput.validationBlocked = false;
      theInput.style.backgroundColor = '';
      theInput.ejemploContainer.style.display = 'none';
    } else {
      areOthersBlocked = ! areAllFieldTypesValid();
      theInput.validationBlocked = true;
      theInput.style.backgroundColor = '#ff9999';
      theInput.ejemploContainer.style.display = '';
      if ( ! areOthersBlocked ) {
        window.setTimeout(function(o){return function(){o.focus()};}(theInput), 50);
      }
    }
    window.setTimeout(function(o){return function(){checkFieldType(o, fieldType);};}(theInput), 250);

    return isTrialOkay;
  }

  function areAllFieldTypesValid() {
    var inputs = document.getElementsByTagName('input');
    for ( ii = 0; ii < inputs.length; ii++ ) {
      if ( inputs[ii].validationBlocked ) return false;
    }
    return true;
  }

  function fullOffsetTop(anElement) {
      var localOffset = anElement.offsetTop;
      if ( anElement.offsetParent ) {
        localOffset += fullOffsetTop(anElement.offsetParent);
      }
      return localOffset;
    }
  function fullOffsetLeft(anElement) {
      var localOffset = anElement.offsetLeft;
      if ( anElement.offsetParent ) {
        localOffset += fullOffsetLeft(anElement.offsetParent);
      }
      return localOffset;
    }
//------------------------------------------------------------------------------------
	//Funcion para validacion de rangos de fechas, retorna true si la fecha dateMayor es mayor que la dateMinor.
	function compareDates(dateMayor,dateMinor,comparationType){
		dateComparedMayor = new Date();
		dateComparedMinor = new Date();
		dateMayor = new String(dateMayor);
		dateMinor = new String(dateMinor);

		//Asignacion de fecha mayor al objeto
		dateMayorArray = dateMayor.split("-");
		//alert('Dia '+dateMayorArray[0]+' Mes '+ dateMayorArray[1]+ ' A�o '+dateMayorArray[2]);
		dateComparedMayor.setDate(dateMayorArray[0]);
		dateComparedMayor.setMonth(dateMayorArray[1]);
		dateComparedMayor.setYear(dateMayorArray[2]);
		if (dateMayorArray > 3){
			dateComparedMayor.setHours(dateMayorArray[3]);
			dateComparedMayor.setMinutes(dateMayorArray[4]);
		}
		//Asignacion de fecha menor al objeto
		dateMinorArray = dateMinor.split("-");
		//alert('Dia '+dateMinorArray[0]+' Mes '+ dateMinorArray[1]+ ' A�o '+dateMinorArray[2]);
		dateComparedMinor.setDate(dateMinorArray[0]);
		dateComparedMinor.setMonth(dateMinorArray[1]);
		dateComparedMinor.setYear(dateMinorArray[2]);
		if (dateMinorArray > 3){
			dateComparedMinor.setHours(dateMinorArray[3]);
			dateComparedMinor.setMinutes(dateMinorArray[4]);
		}
		firstDate = dateComparedMayor.getTime();
		secondDate = dateComparedMinor.getTime();
		if ( (isNaN(firstDate)) || (isNaN(secondDate)))
			return false;
		switch(comparationType){
			case 'less_than':
				if(firstDate < secondDate){
					return true;
				}else{
					return false;
				}
				break
			case 'greater_than':
				if(firstDate > secondDate){
					return true;
				}else{
					return false;
				}
				break
			case 'greater_equal':
				if(firstDate >= secondDate){
					return true;
				}else{
					return false;
				}
				break
			case 'less_equal':
				if(firstDate <= secondDate){
					return true;
				}else{
					return false;
				}
				break
			default:
				alert('ERROR: No type specified for comparison');
		}
	}
//------------------------------------------------------------------------------------
/*
***************************************************************
* Event Listener Function v1.4       													*
* Autor: Carlos R. L. Rodrigues      													*
* Taken From: http://www.jsfromhell.com/geral/event-listener	*
***************************************************************
*/
addEvent = function(o, e, f, s){
    var r = o[r = "_" + (e = "on" + e)] = o[r] || (o[e] ? [[o[e], o]] : []), a, c, d;
    r[r.length] = [f, s || o], o[e] = function(e){
        try{
            (e = e || event).preventDefault || (e.preventDefault = function(){e.returnValue = false;});
            e.stopPropagation || (e.stopPropagation = function(){e.cancelBubble = true;});
            e.target || (e.target = e.srcElement || null);
            e.key = (e.which + 1 || e.keyCode + 1) - 1 || 0;
        }catch(f){}
        for(d = 1, f = r.length; f; r[--f] && (a = r[f][0], o = r[f][1], a.call ? c = a.call(o, e) : (o._ = a, c = o._(e), o._ = null), d &= c !== false));
        return e = null, !!d;
    }
};

removeEvent = function(o, e, f, s){
    for(var i = (e = o["_on" + e] || []).length; i;)
        if(e[--i] && e[i][0] == f && (s || o) == e[i][1])
            return delete e[i];
    return false;
};
//------------------------------------------------------------------------------------

/**
 * Attempts to convert a string representing a dollar
 * currency amount into a float.  Wants the format
 * $99,124.34 with the $ symbol optional.  Returns 0
 * if the input string does not match the format.
 */
function parseCurrency(currencyString)
{
  // cast input to string (in case we are given something else)
  currencyString = currencyString.toString();

  // regexp defining allowed format
  var currencyFormatRegexp = /^\$?\d{1,3}(,\d{3})*(\.\d{1,2})?$/;

  // guard for match against format
  if ( ! currencyFormatRegexp.test(currencyString) ) {
    return 0.0;
  }

  // strip possible $ symbol and all commas, then return as a float.
  return parseFloat(currencyString.replace(/\$|,/g, ''));
}
function permite(elEvento, permitidos) {
  // Variables que definen los caracteres permitidos
  var numeros = "0123456789";
  var caracteres = " abcdefghijklmn�opqrstuvwxyzABCDEFGHIJKLMN�OPQRSTUVWXYZ";
  var numeros_caracteres = numeros + caracteres;
  var teclas_especiales = [8, 37, 39, 46];
  var telefonos = "0123456789-";
  // 8 = BackSpace, 46 = Supr, 37 = flecha izquierda, 39 = flecha derecha
 
 
  // Seleccionar los caracteres a partir del par�metro de la funci�n
  switch(permitidos) {
    case 'num':
      permitidos = numeros;
      break;
    case 'car':
      permitidos = caracteres;
      break;
    case 'num_car':
      permitidos = numeros_caracteres;
      break;
	 case 'tlf':
      permitidos = telefonos;
      break; 
	  
  }
 
  // Obtener la tecla pulsada 
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  var caracter = String.fromCharCode(codigoCaracter);
 
  // Comprobar si la tecla pulsada es alguna de las teclas especiales
  // (teclas de borrado y flechas horizontales)
  var tecla_especial = false;
  for(var i in teclas_especiales) {
    if(codigoCaracter == teclas_especiales[i]) {
      tecla_especial = true;
      break;
    }
  }
 
  // Comprobar si la tecla pulsada se encuentra en los caracteres permitidos
  // o si es una tecla especial
  return permitidos.indexOf(caracter) != -1 || tecla_especial;
}