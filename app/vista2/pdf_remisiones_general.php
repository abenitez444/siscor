<?php 
session_start();
//header('Content-Type: text/html; charset=utf-8');
include('../controlador/script.php');
include("../modelo/BaseDatos.php"); //llamo a las costantes de la conexion  
include('../assets/pdf/class.ezpdf.php');
include_once("../modelo/class_remisiones.php");
include_once("../modelo/class_usuarios.php");

function devuelve_fecha($f)
    {	
	$aux="";
    $aux="$f[8]$f[9]-$f[5]$f[6]-$f[0]$f[1]$f[2]$f[3]";	
	$f=$aux; 
	return $f;		
  }
$pdf = new Cezpdf('legal','landscape'); // para el tipo de hoja  en este caso Carta
$pdf->selectFont('../assets/pdf/fonts/Helvetica.afm');   // para el tipo de fuente a utilizar
$pdf->ezSetCmMargins(1,2,1.5,1.5);  // para los margenes de la hoja
$pdf->ezImage("../assets/img/logo_pdf.jpg",10,170,'none', 'left');
$pagina=mb_convert_encoding('Página: ', "ISO-8859-1", "UTF-8");
$pdf->ezStartPageNumbers(500,18,10,'',''.$pagina.' {PAGENUM} de {TOTALPAGENUM}',1);

$Usuarios = New Usuarios();
$Usuarios->setId($_SESSION['codigo']);
$Usuarios->CargarDatos();
    
	$remitenteEncabezado =array(mb_convert_encoding($Usuarios->getNb_primer_nivel(),"ISO-8859-1", "UTF-8"),mb_convert_encoding($Usuarios->getNb_direcciones(),"ISO-8859-1", "UTF-8"));
    $datatmp_enca= array();
	//echo sizeof($remitenteEncabezado);
      for ($index = 0; $index < sizeof($remitenteEncabezado); $index++) {
	if ($index==2){
		 //$pdf->ezText("<b>Fecha:</b>".date("d/m/Y"),10, array('justification'=>'right'));	
		$datatmp_enca[$index]= array('a'=>'<b>'.$remitenteEncabezado[$index].'</b>','b'=>'','c'=>'Fecha'.date("d/m/Y").''); 
		}	
		else{	
		if($remitenteEncabezado[$index]=='0')
          {
          	$remitenteEncabezado[$index]="";
          }
          //echo $nbDireccion;
          $datatmp_enca[$index]=array('a'=>'<b>'.$remitenteEncabezado[$index].'</b>','b'=>'','c'=>''); 
      	}
      }
      
       $direccion = mb_convert_encoding('Dirección', "ISO-8859-1", "UTF-8"); 
       $cols = array( 
               'a'=>'',
       		   'b'=>'',
       		   'c'=>''
             );

      $pdf->ezTable($datatmp_enca,$cols,'',array('xOrientation'=>'center','width'=>400,'titleFontSize' =>10,'showLines'=>0,'shaded'=>0,'fontSize' =>8,'innerLineThickness'=>0,'outerLineThickness'=>0
             ,'showHeadings' => 0,'cols'=>array(
             'a'=>array('justification'=>'center'),
             'b'=>array('justification'=>'center','width'=>435),
             'c'=>array('justification'=>'center','width'=>200)
             )   
             )); 
      // los resultados de la consulta va aqui BUENA
     		 $pdf->ezText('<b>'.'Listado General de Remisiones'.'</b>',12, array('justification'=>'center'));	
     		 
	  $Remisiones= new Remisiones();
      $Remisiones->setId_direcciones_user($_SESSION['direcciones_user']);
	  $Remisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	  $Remisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
      
	  $tabla= "vista_mostrar_remisiones";
	  $orden="cd_remisiones";		
	 // die($_SESSION['sql']." a ver");
	  $arrResultado = $Remisiones->MostrarConsulta(1,$tabla,$_SESSION['sql'],$orden);
	  $cantidad= $Remisiones->MostrarConsulta(0,$tabla,$_SESSION['sql'],$orden);
	  $iyy = 0;

       $datatmp1= array();
     //echo sizeof($arrResultado);
      for ($index = 0; $index < $cantidad; $index++)
      	  {
	      	  $datatmp=pg_fetch_assoc($arrResultado);
	      	  $anio=$datatmp['nu_ano_remisiones'];
			  $idRemisiones= mb_convert_encoding($datatmp['cd_remisiones'],"ISO-8859-1", "UTF-8");
	          $feEntrada=mb_convert_encoding($datatmp['fe_remisiones'],"ISO-8859-1", "UTF-8");
	          $nbAltoNivel=mb_convert_encoding($datatmp['nb_alto_nivel'],"ISO-8859-1", "UTF-8");
	          $nbPrimerNivel=mb_convert_encoding($datatmp['nb_primer_nivel'],"ISO-8859-1", "UTF-8");
	          $nbDireccion=mb_convert_encoding($datatmp['nb_direcciones'],"ISO-8859-1", "UTF-8");
	          $nbUnidades=mb_convert_encoding($datatmp['nb_unidades'],"ISO-8859-1", "UTF-8");
	          $nbCoordinaciones=mb_convert_encoding($datatmp['nb_coordinaciones'],"ISO-8859-1", "UTF-8");
	          
	          $id_recibidas=mb_convert_encoding($datatmp['cd_recibidas'],"ISO-8859-1", "UTF-8");
	          $id_anio=mb_convert_encoding($datatmp['nu_ano_recibidas'],"ISO-8859-1", "UTF-8");
	          
	          $Asunto=mb_convert_encoding($datatmp['tx_observacion_remisiones'],"ISO-8859-1", "UTF-8");
			  $nbRecibido=mb_convert_encoding($datatmp['nb_recibidapor_remisiones'],"ISO-8859-1", "UTF-8");
			  $hora=mb_convert_encoding($datatmp['nu_hora_hh_recibidapor_remisiones'],"ISO-8859-1", "UTF-8");
			  $minuto=mb_convert_encoding($datatmp['nu_hora_mm_recibidapor_remisiones'],"ISO-8859-1", "UTF-8");
			  $tiempo=mb_convert_encoding($datatmp['nu_hora_tt_recibidapor_remisiones'],"ISO-8859-1", "UTF-8");
			  $ferecibida=mb_convert_encoding($datatmp['fe_recibidapor_remisiones'],"ISO-8859-1", "UTF-8");
			  $nbResponsable=mb_convert_encoding($datatmp['nb_responsable_remisiones'],"ISO-8859-1", "UTF-8");
			  
			  if ($minuto == 61){
			  	$minuto=0;
			  }
			  
			if($_SESSION['respuesta']==1)
			{
				//print_r($datatmp['in_respuesta_remisiones']);
         		if($datatmp['in_respuesta_remisiones']=='t')
          		{

          			$Res='SI';
					$TxtRespuesta= mb_convert_encoding($datatmp['tx_respuesta_remisiones'],"ISO-8859-1", "UTF-8");
	          	}
	          	else
	          	{
	          		$Res='NO';
	          		$TxtRespuesta= mb_convert_encoding($datatmp['tx_respuesta_remisiones'],"ISO-8859-1", "UTF-8");
    	
          		}
			}
          
          if($nbDireccion=='0')
          {
          	$nbDireccion="";
          }
          $feEntrada=devuelve_fecha($feEntrada);
          $ferecibida=devuelve_fecha($ferecibida);
          
          if($_SESSION['perfil']==1)
          {
          	$a=$nbAltoNivel."\n".$nbPrimerNivel."\n".$nbDireccion."\n".$nbUnidades;	
          }
          //else if($_SESSION['perfil']==2)
          else
          {
          	$a=$nbAltoNivel."\n".$nbPrimerNivel."\n".$nbDireccion."\n".$nbUnidades."\n".$nbCoordinaciones;
          }
       /*   else if($_SESSION['perfil']==3)
          {
          	
          }*/
  		  if($hora=="")
		  {
		  	$recibido=$nbRecibido." ".$tiempo."\n";
		  }
		  else 
		  {
		  	$recibido=$nbRecibido."\n".$ferecibida."        ".$hora.":".$minuto." ".$tiempo."\n";	
		  }
          
		  $cod_recibida= $id_recibidas . " / ". $id_anio;
		  
		  
      	   if ($_SESSION['perfil']==1)
          {
          	
		  	if($_SESSION['respuesta']==1)
          	{
          		$datatmp1[$index]=array('cd_remisiones'=>$idRemisiones,'fe_remisiones'=>$feEntrada,'cod_recibida'=>$cod_recibida,'nb_alto_nivel'=>$a,'nb_primer_nivel'=>$nbPrimerNivel,'nb_direcciones'=>$nbDireccion,'tx_observacion_remisiones'=>$Asunto,'in_respuesta_remisiones'=>$Res,'nb_responsable_remisiones'=>$nbResponsable,'tx_respuesta_remisiones'=>$TxtRespuesta);
          	}
          	else
          	{
          		$datatmp1[$index]=array('cd_remisiones'=>$idRemisiones,'fe_remisiones'=>$feEntrada,'cod_recibida'=>$cod_recibida,'nb_alto_nivel'=>$a,'nb_primer_nivel'=>$nbPrimerNivel,'nb_direcciones'=>$nbDireccion,'tx_observacion_remisiones'=>$Asunto,'nb_recibidapor_remisiones'=>$recibido);
          	}

          }
          else
          {
          	if($_SESSION['respuesta']==1)
          	{
          		$datatmp1[$index]=array('cd_remisiones'=>$idRemisiones,'fe_remisiones'=>$feEntrada,'cod_recibida'=>$cod_recibida,'nb_alto_nivel'=>$a,'nb_primer_nivel'=>$nbPrimerNivel,'nb_direcciones'=>$nbDireccion,'tx_observacion_remisiones'=>$Asunto,'in_respuesta_remisiones'=>$Res,'nb_responsable_remisiones'=>$nbResponsable,'tx_respuesta_remisiones'=>$TxtRespuesta);
          	}
          	else
          	{
          		$datatmp1[$index]=array('cd_remisiones'=>$idRemisiones,'fe_remisiones'=>$feEntrada,'cod_recibida'=>$cod_recibida,'nb_alto_nivel'=>$a,'nb_primer_nivel'=>$nbPrimerNivel,'nb_direcciones'=>$nbDireccion,'tx_observacion_remisiones'=>$Asunto,'nb_responsable_remisiones'=>$nbResponsable);
          	}          	
          
          }
          
          
          
      }
	   $anio = mb_convert_encoding('Año', "ISO-8859-1", "UTF-8");
	   $remision = mb_convert_encoding('Remisión', "ISO-8859-1", "UTF-8");
       $direccion = mb_convert_encoding('Dirección', "ISO-8859-1", "UTF-8");
       if($_SESSION['respuesta']==1)
       {

       	$titles = array(
               'cd_remisiones'=>'<b>No. '.$remision.'</b>',
	           'fe_remisiones'=>'<b>Fecha</b>',
       		   'cod_recibida'=>'<b>No. Recibida /'.$anio.' </b>',
  	           'nb_alto_nivel'=>'<b>Destinatario</b>',
               'tx_observacion_remisiones'=>'<b>Asunto</b>',
       		   'in_respuesta_remisiones'=>'<b>Resp.</b>',
		       'nb_responsable_remisiones'=>'<b>Responsable</b>',
       		   'tx_respuesta_remisiones'=>'<b>Respuesta</b>'
       		   );

       }
       else
       {
			if ($_SESSION['perfil']==1)
			{
				$titles = array(
        	       'cd_remisiones'=>'<b>No. '.$remision.'</b>',
	        	   'fe_remisiones'=>'<b>Fecha</b>',
				   'cod_recibida'=>'<b>No. Recibida /'.$anio.' </b>',
	           	   'nb_alto_nivel'=>'<b>Remitente</b>',
               	   'tx_observacion_remisiones'=>'<b>Asunto</b>',
              	   'nb_recibidapor_remisiones'=>'<b>Recibido por</b>');		
			}
			//else if($_SESSION['perfil']==2)
			else
			{
				$titles = array(
        	       'cd_remisiones'=>'<b>No. '.$remision.'</b>',
	        	   'fe_remisiones'=>'<b>Fecha</b>',
				   'cod_recibida'=>'<b>No. Recibida /'.$anio.' </b>',
	           	   'nb_alto_nivel'=>'<b>Remitente</b>',
               	   'tx_observacion_remisiones'=>'<b>Asunto</b>',
              	   'nb_responsable_remisiones'=>'<b>Responsable</b>');					
			}
       	
             
       	
       
       }
             
             
      $options = array(
                'shadeCol'=>array(0.9,0.9,0.9),
                'xOrientation'=>'center',
                'width'=>800,
		        'shadeCol2' =>array(0.7,0.7,0.7),
                'innerLineThickness'=>2,
                'outerLineThickness'=>2,
                'yPos' => 'center',
                'showHeadings' => 1,
           );


	  $txt_desde_hasta="<b>".$_SESSION['titulo']." Desde: ".$_SESSION['desde']." Hasta: ".$_SESSION['hasta']."</b>";	
	  $txtblanco = "<b></b>\n";
      $pdf->ezText($txt_desde_hasta,12, array('justification'=>'center'));
      $pdf->ezText($txtblanco, 12);
      $pdf->ezTable($datatmp1,$titles, '', $options);  // los resultados de la consulta va aqui

     $pdfcode = $pdf->ezOutput();
	  $pdf->ezStream();
?>