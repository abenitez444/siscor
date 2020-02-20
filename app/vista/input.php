<?php
/*
==============================================================================
 lib/function/input.php
		Funciones para la creacion de objetos Input de HTML

		Version: 1.0
		Author: Papa <gvegas@micorp.com.ve>
		Date: 13/12/2005
		License: Need to be said?
==============================================================================
*/
if( defined( '_LIB_INPUT' )) {
	return;
}

define( '_LIB_INPUT', '1.0' );

//--------------------------------------------------------------------------------------------------------------------
//Create_SelectInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_SelectInput($nombre, $Values, $ValorActual, $JavaAction = "", $estilo = "", $class = "indata", $suppressId = false,$status = "") {

	$idAttribute = ' id="' . $nombre . '" ';
	if ( $suppressId ) $idAttribute = ' ';

	echo "&nbsp;<select name='" . $nombre . "'" . $idAttribute . "class='" . $class ."' " . $JavaAction . " style='" . $estilo ."' ".$status.">";

	while( list( $key, $label ) = each($Values)) {
			echo "<option value='". $key . "' " . (trim($key)==trim($ValorActual)?"SELECTED":"") . " >". $label ."</option>\n";
	}

	echo "</select>";
}

//--------------------------------------------------------------------------------------------------------------------
//Create_MultiSelectInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_MultiSelectInput($nombre, $Values, $ValorActual, $size=10, $JavaAction = "", $estilo = "indata", $class = "indata",$id=""){

	if (trim($id != ""))
		$idAttribute = ' id=\'' . $id . '\' ';
	else
		$idAttribute = ' id=\'' . $nombre . '\' ';

	echo "<select name='" . $nombre . "' " . $idAttribute . " class='" . $class ."' " . $JavaAction . " MULTIPLE SIZE=". $size ." style='" . $estilo ."'>";

	if ($ValorActual != ""){
		$Valores = Split("," , $ValorActual);
	}
	else{
		$Valores = array();
	}

	while( list( $key, $label ) = each($Values)) {
			echo "<option value='". $key . "' " . (in_array($key, $Valores)?"SELECTED":"") . " >". $label ."</option>\n";
	}

	echo "</select>";
}

//--------------------------------------------------------------------------------------------------------------------
//Create_OptionInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_OptionInput($nombre, $Label="", $Value, $ValorActual, $JavaAction = "", $estilo = "", $class = "indata", $status = "", $id = "") {

	if ($id == "")
		$id = $nombre;

	$sObjeto = "<input type='radio' name='" . $nombre . "' id='" . $id ."' value='" . $Value . "' class='" . $class . "' " . $JavaAction . " style='" . $estilo ."' ";
	$sObjeto .= ($Value==$ValorActual?"checked":"") . "> " . $Label;

	echo $sObjeto;

}


//--------------------------------------------------------------------------------------------------------------------
//Create_CheckInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_CheckInput($nombre, $Label="", $Value, $ValorActual, $JavaAction = "", $estilo = "", $class = "indata") {

	$sObjeto = "<input type='checkbox' name='" . $nombre . "' id='" . $nombre . "' value='" . $Value . "' class='" . $class . "' " . $JavaAction . " style='" . $estilo ."' ";

	if ($ValorActual != ""){
		$Valores = Split("," , $ValorActual);
	}
	else{
		$Valores = array();
	}

	$sObjeto .= (in_array($Value,$Valores)?"checked":"") . "> " . $Label;

	echo $sObjeto;

}

//--------------------------------------------------------------------------------------------------------------------
//Create_SubmitInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_SubmitInput($nombre, $Value, $JavaAction = "", $estilo = "", $class = "button"){

	if ($JavaAction != "") {
		$Tipo = "button";
	}
	else {
		$Tipo = "submit";
	}

	$sObjeto = "&nbsp;<input type='". $Tipo . "' name='" . $nombre . "' value='" . $Value . "' class='" . $class . "' " . $JavaAction . " style='" . $estilo ."'>";

	echo $sObjeto;

}

//--------------------------------------------------------------------------------------------------------------------
//Create_DirectSubmitInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_DirectSubmitInput($nombre, $Value, $JavaAction = "", $estilo = "", $class = "button", $id = ""){

  $Tipo = "submit";
  $idClause = '';

  if ( ! empty($id) ) $idClause = ' id="' . $id . '" ';

	$sObjeto = "&nbsp;<input type='". $Tipo . "' name='" . $nombre . "' value='" . $Value . "' class='" . $class . "' " . $JavaAction . " style='" . $estilo ."' $idClause >";

	echo $sObjeto;

}

//--------------------------------------------------------------------------------------------------------------------
//Create_TextArea :
//--------------------------------------------------------------------------------------------------------------------

function Create_TextArea($nombre, $Value, $Cols=60, $Rows=5 , $JavaAction = "", $estilo = "", $class = "indata", $status="", $id="" ){

	if ($id == "")
		$id = $nombre;
	$sObjeto = "&nbsp;<textarea ".$status." name='" . $nombre . "' id='" . $id . "' class='" . $class . "' COLS='" . $Cols . "' ROWS='" . $Rows . "' " . $JavaAction . " style='" . $estilo ."'>" . $Value . "</textarea>";
	echo $sObjeto;

}

//--------------------------------------------------------------------------------------------------------------------
//Create_BoxInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_BoxInput($nombre, $Label="", $Value, $Size, $Maxlength, $JavaAction = "", $estilo = "", $class = "indata", $status = '', $suppressId = false) {

	$idAttribute = ' id="' . $nombre . '" ';
	if ( $suppressId ) $idAttribute = ' ';

	$JavaAction .= " onfocus='this.select()' ";

	$sObjeto = "&nbsp;<input $status type='text' name='" . $nombre . "'" . $idAttribute . "class='" . $class ."' size='" . $Size . "' maxlength='" . $Maxlength . "' " . $JavaAction . " style='" . $estilo ."' ";
	$sObjeto .= " value='" . $Value ."'>";

	$sObjeto = $Label . $sObjeto;

	echo $sObjeto;

}


//--------------------------------------------------------------------------------------------------------------------
//Create_PasswordInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_PasswordInput($nombre, $Label="", $Value, $Size, $Maxlength, $JavaAction = "", $estilo = "indata") {

	$sObjeto = "&nbsp;<input type='PASSWORD' name='" . $nombre . "' class='indata' size='" . $Size . "' maxlength='" . $Maxlength . "' " . $JavaAction . " style='" . $estilo ."' ";
	$sObjeto .= "' value='" . $Value .">";

	$sObjeto = $Label . $sObjeto;

	echo $sObjeto;

}


//--------------------------------------------------------------------------------------------------------------------
//Create_FileInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_FileInput($nombre, $Label="", $Size, $estilo = "") {

	$sObjeto = "&nbsp;<input type='file' name='" . $nombre . "' class='indata' size='" . $Size . "' style='" . $estilo ."'>";
	$sObjeto = $Label . $sObjeto;

	echo $sObjeto;

}


//--------------------------------------------------------------------------------------------------------------------
//Create_HiddenInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_HiddenInput($nombre, $Value) {

	$sObjeto = "<input type='HIDDEN' name='" . $nombre . "' id='" . $nombre . "' value='" . $Value . "'>";
	echo $sObjeto;

}

//--------------------------------------------------------------------------------------------------------------------
//Create_Link :
//--------------------------------------------------------------------------------------------------------------------

function Create_Link($URL, $Text, $Target = "", $JavaAction = "", $estilo = "") {

	$sObjeto = "<a href='" . $URL . "' target='" . $Target . "' " . $JavaAction . " style='" . $estilo ."'>";
	$sObjeto .= $Text . "</a>";
	echo $sObjeto;

}

//--------------------------------------------------------------------------------------------------------------------
//Create_DateInput :
//Value: hash with keys ano, mes, dia
//--------------------------------------------------------------------------------------------------------------------

function Create_DateInput($nombre, $Value, $JavaAction = '', $estilo = 'indata', $class = 'indata', $disabled = false) {

	$Value = substr($Value,0,10);

//	list($year, $month, $day) = split('[/.-]', $Value);
	list($year, $month, $day) = explode('[/.-]', $Value);

	if (strlen($year) == 4){
		$Value = $day . "-" . $month . "-" . $year;
	}

	$isDisabled = $disabled ? 'disabled' : '';

	$sObjeto = "&nbsp;<input " . $isDisabled . " type='text' title='Presione para ver el Calendario.' name='" . $nombre . "' id='" . $nombre . "' class='" . $class ."' size='10' readonly style='" . $estilo ."' ";
	$sObjeto .= " value='" . $Value ."'>";
	//$sObjeto .= "<img src='/img/calendar/calendar.jpg' name='cal_$nombre' id='cal_$nombre' border='0' alt='Presione para ver el Calendario.'>";
   
	$sObjeto .="<script>var cal_$nombre = new Epoch('nombre','popup',getObj('$nombre'),false);</script>";

	echo $sObjeto;

/*
	$sObjeto = "<script type='text/javascript'>DateInput('$nombre', true, 'YYYY-MM-DD','$Value','$estilo','')</script>";
	$sObjeto = "<script>var cal_input1 = new Epoch('$nombre','popup',$Value,false);</script>";

  if ( empty($Value) ) $Value = array('ano' => 'aaaa', 'mes' => 'mm', 'dia' => 'dd');

  $nombreAno = $nombre . '[ano]';
  $nombreMes = $nombre . '[mes]';
  $nombreDia = $nombre . '[dia]';

	$sObjeto = "&nbsp;<input " . ($disabled ? 'disabled' : '') . " type='text' name='" . $nombreAno . "' id='" . $nombreAno . "' class='" . $class ."' size='" . 4 . "' maxlength='" . 4 . "' " . $JavaAction . " style='" . $estilo ."' ";
	$sObjeto .= " value='" . $Value['ano'] ."'>";

	$sObjeto .= "-<input " . ($disabled ? 'disabled' : '') . " type='text' name='" . $nombreMes . "' id='" . $nombreMes . "' class='" . $class ."' size='" . 2 . "' maxlength='" . 2 . "' " . $JavaAction . " style='" . $estilo ."' ";
	$sObjeto .= " value='" . $Value['mes'] ."'>";

 	$sObjeto .= "-<input " . ($disabled ? 'disabled' : '') . " type='text' name='" . $nombreDia . "' id='" . $nombreDia . "' class='" . $class ."' size='" . 2 . "' maxlength='" . 2 . "' " . $JavaAction . " style='" . $estilo ."' ";
	$sObjeto .= " value='" . $Value['dia'] ."'>";

  echo '<span id="' . $nombre . '">' . $sObjeto . '</span>';

*/
}

//--------------------------------------------------------------------------------------------------------------------
//Create_TimeInput :
//--------------------------------------------------------------------------------------------------------------------

function Create_TimeInput($nombre, $Value=array('hora'=>'11','minuto'=>'24')) {

	$sObjeto = "&nbsp;<input class='indata' type='text' maxlength='2' size='2' name='" . $nombre . "[hora]' value='" . $Value['hora'] ."'>";
	$sObjeto .= "&nbsp;:&nbsp;<input class='indata' type='text' maxlength='2' size='2' name='" . $nombreMes . "[minuto]' value='" . $Value['minuto'] ."'>";

	echo $sObjeto;

}

//--------------------------------------------------------------------------------------------------------------------
//Create_Table :
//--------------------------------------------------------------------------------------------------------------------

Function Create_Table($vHeader, $Values){

	include('local/settings.php');

	$lAncho = 100 / count($vHeader);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td colspan="2"><img src="/img/list/main_table_izq_up.gif"></td>
	<td width="98%" background="/img/list/main_table_mid_up.gif">&nbsp;</td>
	<td colspan="2"><img src="/img/list/main_table_der_up.gif"></td>
</tr>

<tr>
	<td background="/img/list/main_table_izq_mid.gif"></td>
	<td colspan="3">

<?php
	echo "<table width='100%' border='0' cellpadding='2' cellspacing='1' >";
	echo "<TR>";

	foreach($vHeader as $key => $Item ){
		echo "<TD class='titulo' align='left' width='" . $Item['size'] . "%'>" . $key . "</TD>";
	}

	echo "</TR>";

	$count_pag = 1;

	if (!is_null($Values)){
		foreach($Values as $Item ){
			$class_line = "query_basic_lista_" . ($count_pag %2);
			echo "<TR class='" . $class_line. "'>";

			foreach($vHeader as $Col ){
				$valor = $Item[$Col['field']];

				if ($LibSettings->is_number($valor)){
						$align = "left";
				} elseif ($LibSettings->is_date($valor)) {
						$align = "left";
				} else {
						$align = "left";
				}
				echo "<TD class='texto' align='$align'>" . $valor . "</TD>";
			}

			echo "</TR>";

			$count_pag++;
		}
	}

	echo "</TABLE>";

?>

	</td>
	<td background="/img/list/main_table_der_mid.gif"></td>
	</tr>
	<tr>
		<td><img src="/img/list/main_table_izq_bot1.gif"></td>
		<td><img src="/img/list/main_table_izq_bot2.gif"></td>
		<td background="/img/list/main_table_mid_bot.gif"></td>
		<td><img src="/img/list/main_table_der_bot2.gif"></td>
		<td><img src="/img/list/main_table_der_bot1.gif"></td>
	</tr>
	</table>

<?php

}


//--------------------------------------------------------------------------------------------------------------------
//SetArrayLista :
//--------------------------------------------------------------------------------------------------------------------


function SetArrayLista($Datos, $FirstValue, $NoValue, $FirstKey = ''){

	$ArrayRes = array();

	if (count($Datos) > 0) {
		if ($FirstValue != "") {
			
			$ArrayRes[$FirstKey] = $FirstValue;

			foreach( $Datos as $keyValue => $Value) {
				$ArrayRes[$keyValue] = $Value;
			}
		}
		else
		{
			$ArrayRes = $Datos;
		}
	}
	else
	{
		$ArrayRes[$FirstKey] = $NoValue;
	}

	return $ArrayRes;
}

//--------------------------------------------------------------------------------------------------------------------

function SetArrayLista_FromDominio($Datos, $FirstValue, $NoValue){

	$ArrayRes = array();

	if (count($Datos) > 0) {

		if ($FirstValue != "") {
			$ArrayRes[''] = $FirstValue;
		}

		foreach( $Datos as $keyValue => $Value) {
			$ArrayRes[$Value['value']] = $Value['name'];
		}
	}
	else
	{
		$ArrayRes[''] = $NoValue;
	}

	return $ArrayRes;
}
function ts_to_date($timestamp) {
			$format['day'] 			= date("d", $timestamp);
			$format['month'] 		= date("m", $timestamp);
			$format['year'] 		= date("Y", $timestamp);
			$format['hour'] 		= date("G", $timestamp);
			$format['minute'] 	= date("i", $timestamp);
			return $format;
		}

		#---------------------------------------------------------------------
		function date_to_ts($date) {
			list($day, $month, $year, $hours, $minutes) = split('[/.-]', $date);
			return mktime($hours, $minutes, 0, $month  ,$day , $year);
		}

		#---------------------------------------------------------------------
		function ts_today() {
			list($day, $month, $year, $hours, $minutes, $seconds) = split('[/:-]', date('d-m-Y-H:i:s'));
			return mktime($hours, $minutes, $seconds, $month  ,$day , $year);
		}

		#---------------------------------------------------------------------
		function Format_Date($fecha, $format = 'DMY') {

			if ($fecha =='')	return '';

			list($year, $month, $day) = split('[/.-]', $fecha);

			$day = substr($day, 0,2);

			if ($format == 'DMY')
				return $day . "/" . $month . "/" . $year;
			else
				return $month . "/" . $day . "/" . $year;
		}

		#---------------------------------------------------------------------
		function Format_DateDB($fecha) {

			if ($fecha =='')	return '';

			list($day, $month, $year) = split('[/.-]', $fecha);
			return $year . "-" . $month . "-" . $day;
		}
#---------------------------------------------------------------------
function numtoletras($xcifra)
{ 
$xarray = array(0 => "Cero",
1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE", 
"DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE", 
"VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA", 
100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
);
//
$xcifra = trim($xcifra);
$xlength = strlen($xcifra);
$xpos_punto = strpos($xcifra, ".");
$xaux_int = $xcifra;
$xdecimales = "00";
if ($xpos_punto > 0)
	{
	$xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
	$xdecimales = substr($xcifra."00", $xpos_punto + 1, 2); // obtengo los valores decimales
	}

$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
$xcadena = "";
for($xz = 0; $xz < 3; $xz++)
	{
	$xaux = substr($XAUX, $xz * 6, 6);
	$xi = 0; $xlimite = 6; // inicializo el contador de centenas xi y establezco el l�mite a 6 d�gitos en la parte entera
	$xexit = true; // bandera para controlar el ciclo del While	
	while ($xexit)
		{
		if ($xi == $xlimite) // si ya lleg� al l�mite m&aacute;ximo de enteros
			{
			break; // termina el ciclo
			}
	
		$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
		$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres d�gitos)
		for ($xy = 1; $xy < 4; $xy++) // ciclo para revisar centenas, decenas y unidades, en ese orden
			{
			switch ($xy) 
				{
				case 1: // checa las centenas
					if (substr($xaux, 0, 3) < 100) // si el grupo de tres d�gitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
						{
						}
					else
						{
						$xseek = $xarray[substr($xaux, 0, 3)]; // busco si la centena es n�mero redondo (100, 200, 300, 400, etc..)
						if ($xseek)
							{
							$xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Mill�n, Millones, Mil o nada)
							if (substr($xaux, 0, 3) == 100) 
								$xcadena = " ".$xcadena." CIEN ".$xsub;
							else
								$xcadena = " ".$xcadena." ".$xseek." ".$xsub;
							$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
							}
						else // entra aqu� si la centena no fue numero redondo (101, 253, 120, 980, etc.)
							{
							$xseek = $xarray[substr($xaux, 0, 1) * 100]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
							$xcadena = " ".$xcadena." ".$xseek;
							} // ENDIF ($xseek)
						} // ENDIF (substr($xaux, 0, 3) < 100)
					break;
				case 2: // checa las decenas (con la misma l�gica que las centenas)
					if (substr($xaux, 1, 2) < 10)
						{
						}
					else
						{
						$xseek = $xarray[substr($xaux, 1, 2)];
						if ($xseek)
							{
							$xsub = subfijo($xaux);
							if (substr($xaux, 1, 2) == 20)
								$xcadena = " ".$xcadena." VEINTE ".$xsub;
							else
								$xcadena = " ".$xcadena." ".$xseek." ".$xsub;
							$xy = 3;
							}
						else
							{
							$xseek = $xarray[substr($xaux, 1, 1) * 10];
							if (substr($xaux, 1, 1) * 10 == 20)
								$xcadena = " ".$xcadena." ".$xseek;
							else	
								$xcadena = " ".$xcadena." ".$xseek." Y ";
							} // ENDIF ($xseek)
						} // ENDIF (substr($xaux, 1, 2) < 10)
					break;
				case 3: // checa las unidades
					if (substr($xaux, 2, 1) < 1) // si la unidad es cero, ya no hace nada
						{
						}
					else
						{
						$xseek = $xarray[substr($xaux, 2, 1)]; // obtengo directamente el valor de la unidad (del uno al nueve)
						$xsub = subfijo($xaux);
						$xcadena = " ".$xcadena." ".$xseek." ".$xsub;
						} // ENDIF (substr($xaux, 2, 1) < 1)
					break;
				} // END SWITCH
			} // END FOR
			$xi = $xi + 3;
		} // ENDDO

		if (substr($xcadena, -6, 6) == "MILLON") // si la cadena obtenida termina en MILLON, entonces le agrega al fina la palabra DE
			$xcadena.= " DE";
			
		if (substr($xcadena, -8, 8) == "MILLONES") // si la cadena obtenida en MILLONES, entoncea le agrega al fina la palabra DE
			$xcadena.= " DE";
		
		// ----------- esta l�nea la puedes cambiar de acuerdo a tus necesidades o a tu pa�s -------
		if (trim($xaux) != "")
			{
			switch ($xz)
				{
				case 0:
					if (trim(substr($XAUX, $xz * 6, 6)) == "1")
						$xcadena.= "UN BILLON ";
					else
						$xcadena.= " BILLONES ";
					break;
				case 1:
					if (trim(substr($XAUX, $xz * 6, 6)) == "1")
						$xcadena.= "UN MILLON ";
					else
						$xcadena.= " MILLONES ";
					break;
				case 2:
					if ($xcifra < 1 )
						{
						$xcadena = "CERO BOLIVARES CON $xdecimales/100 CENTIMOS";
						}
					if ($xcifra >= 1 && $xcifra < 2)
						{
						$xcadena = "UN BOLIVAR CON $xdecimales/100 CENTIMOS ";
						}
					if ($xcifra >= 2)
						{
						$xcadena.= " BOLIVARES CON $xdecimales/100 CENTIMOS "; // 
						}
					break;
				} // endswitch ($xz)
			} // ENDIF (trim($xaux) != "")
		// ------------------      en este caso, para M�xico se usa esta leyenda     ----------------
		
		$xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
		$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
		$xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
		$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
		$xcadena = str_replace("BILLON MILLONES", "BILLON", $xcadena); // corrigo la leyenda
		$xcadena = str_replace("BILLONES MILLONES", "BILLONES", $xcadena); // corrigo la leyenda
		
		
	} // ENDFOR	($xz)
	return trim($xcadena);
} // END FUNCTION

#---------------------------------------------------------------------
function subfijo($xx)
	{ // esta funci�n regresa un subfijo para la cifra
	$xx = trim($xx);
	$xstrlen = strlen($xx);
	if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
		$xsub = "";
	//	
	if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
		$xsub = "MIL";
	//
	return $xsub;
	} // END FUNCTION
?>


