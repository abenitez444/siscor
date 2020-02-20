<?php 
session_start();
//header('Content-Type: text/html; charset=utf-8');
include('../controlador/script.php');
include("../modelo/BaseDatos.php"); //llamo a las costantes de la conexion  
include('../assets/pdf/class.ezpdf.php');
include_once("../modelo/class_recibidas.php");
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
     		 $pdf->ezText('<b>'.'Listado General de Correspondencia Recibida'.'</b>',12, array('justification'=>'center'));	
     		 
	  $Recibidas= new Recibidas();
      $Recibidas->setId_direcciones_user($_SESSION['direcciones_user']);
	  $Recibidas->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
	  $Recibidas->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
      
	  $tabla= "vista_mostrar_recibidas";
	  
	  $orden="cd_recibidas";		
	  $_SESSION['sql'];
	  $arrResultado = $Recibidas->MostrarConsulta(1,$tabla,$_SESSION['sql'],$orden);
	  $cantidad= $Recibidas->MostrarConsulta(0,$tabla,$_SESSION['sql'],$orden);
	  $iyy = 0;

       $datatmp1= array();
     //echo sizeof($arrResultado);
      for ($index = 0; $index < $cantidad; $index++) {
      	  $datatmp=pg_fetch_assoc($arrResultado);
      	  $anio=$datatmp['nu_ano_recibidas'];
		  $idRecibida= mb_convert_encoding($datatmp['cd_recibidas'],"ISO-8859-1", "UTF-8");
          $feEntrada=mb_convert_encoding($datatmp['fe_entrada_recibidas'],"ISO-8859-1", "UTF-8");
          $nbAltoNivel=mb_convert_encoding($datatmp['nb_alto_nivel_corres'],"ISO-8859-1", "UTF-8");
          $nbPrimerNivel=mb_convert_encoding($datatmp['nb_primer_nivel_corres'],"ISO-8859-1", "UTF-8");
          $nbDireccion=mb_convert_encoding($datatmp['nb_direcciones_corres'],"ISO-8859-1", "UTF-8");
          $Asunto=mb_convert_encoding($datatmp['tx_asunto_recibidas'],"ISO-8859-1", "UTF-8");
          
			
			if($_SESSION['respuesta']==1)
			{
         		if($datatmp['in_respuesta_recibidas']==true)
          		{
		          	$tabla1= "vista_mostrar_consul_respuesta_recibidas";
		            $orden1="cd_recibidas";		
			  		$where='cd_recibidas ='.$idRecibida.' and  nu_ano_recibidas='.$anio;
			  		$respuesta_recibidas = $Recibidas->MostrarConsulta(1,$tabla1,$where,$orden1);
			  		$datatmp=pg_fetch_assoc($respuesta_recibidas);
			  		if($datatmp['cd_oficios']<>""){
			  			$Res='SI';
			  			$idOficios= mb_convert_encoding($datatmp['cd_oficios'],"ISO-8859-1", "UTF-8");
		          		$anioOficios= mb_convert_encoding($datatmp['nu_ano_oficios'],"ISO-8859-1", "UTF-8");
		          	}
		          	else
		          	{
		            	$idOficios= "";
		          		$anioOficios= "";
		          		$Res='NO';
		          	}          	
          		}
			}
          
          if($nbDireccion=='0')
          {
          	$nbDireccion="";
          }
          $feEntrada=devuelve_fecha($feEntrada);
          $a=$nbAltoNivel."\n".$nbPrimerNivel."\n".$nbDireccion."\n";

          //echo $nbDireccion;
          if($_SESSION['respuesta']==1)
          {
          	$datatmp1[$index]=array('cd_recibidas'=>$idRecibida,'fe_entrada_recibidas'=>$feEntrada,'nb_alto_nivel_corres'=>$a,'nb_primer_nivel_corres'=>$nbPrimerNivel,'nb_direcciones_corres'=>$nbDireccion,'tx_asunto_recibidas'=>$Asunto,'in_respuesta_recibidas'=>$Res,'cd_oficios'=>$idOficios,'nu_ano_oficios'=>$anioOficios);
          }
          else
          {
          	$datatmp1[$index]=array('cd_recibidas'=>$idRecibida,'fe_entrada_recibidas'=>$feEntrada,'nb_alto_nivel_corres'=>$a,'nb_primer_nivel_corres'=>$nbPrimerNivel,'nb_direcciones_corres'=>$nbDireccion,'tx_asunto_recibidas'=>$Asunto);
          }
      
      }

       $direccion = mb_convert_encoding('Dirección', "ISO-8859-1", "UTF-8");
       if($_SESSION['respuesta']==1)
       {
       	$titles = array(
               'cd_recibidas'=>'<b>No. Correlativo</b>',
	           'fe_entrada_recibidas'=>'<b>Fecha</b>',
	           'nb_alto_nivel_corres'=>'<b>Remitente</b>',
               'tx_asunto_recibidas'=>'<b>Asunto</b>',
       		   'in_respuesta_recibidas'=>'<b>Resp.</b>',
               'cd_oficios'=>'<b>Oficio Resp.</b>',
       		   'nu_ano_oficios'=>'<b>Fec. Resp.</b>'
             );
       }
       else
       {
       	$titles = array(
               'cd_recibidas'=>'<b>No. Correlativo</b>',
	           'fe_entrada_recibidas'=>'<b>Fecha</b>',
	           'nb_alto_nivel_corres'=>'<b>Remitente</b>',
               'tx_asunto_recibidas'=>'<b>Asunto</b>'
             );
       	
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

     // $txttit = "<b>Listado General de Correspondencia Recibida</b>\n";     // se crea titulo y subtitulo de texto
	  $txt_desde_hasta="<b>".$_SESSION['titulo']." Desde: ".$_SESSION['desde']." Hasta: ".$_SESSION['hasta']."</b>";	

	  $txtblanco = "<b></b>\n";

     // $pdf->ezText($txttit,14, array('justification'=>'center'));
      $pdf->ezText($txt_desde_hasta,12, array('justification'=>'center'));
      $pdf->ezText($txtblanco, 12);
      $pdf->ezTable($datatmp1,$titles, '', $options);  // los resultados de la consulta va aqui

	  //$pdf->ezText($pattern, 12);
         // Fecha y hora en que se genera documento
     // $pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
     $pdfcode = $pdf->ezOutput();
	  $pdf->ezStream();
?>