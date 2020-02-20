<?php
session_start();
include('../controlador/script.php');
include_once("../modelo/class_remisiones.php"); 
include_once("../modelo/class_respuesta_remisiones.php"); 
include_once("../modelo/class_modulosxusuarios.php");



$Remisiones = new Remisiones();
$Modulosxusuarios = new Modulosxusuarios();

$Remisiones->setId_usuario($_SESSION['codigo']);
$Remisiones->setId_direcciones_user($_SESSION['direcciones_user']);
$Remisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
$Remisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);

$intPermisoConsultar =$Modulosxusuarios->Existe($Remisiones->getId_usuario(),'in_consultar',"TRUE",7);

$intPermisoModificar =$Modulosxusuarios->Existe($Remisiones->getId_usuario(),'in_modificar',"TRUE",7);
if($intPermisoModificar==1)
{
        $_SESSION['modificar']=1;
}
else
{
        $_SESSION['modificar']=0;
}

if ($_SESSION['perfil']==1 && $intPermisoConsultar==1 || $intPermisoModificar==1)
{
    if($_POST['consultar']==true)
    {
        $Remisiones->setAnio_remision($_POST['ano_consulta']);
        $Remisiones->setId($_POST['num_correlativo']);
        $Resp=$Remisiones->CargarDatos();
        if($Resp == False)
        {
            $_SESSION['estatus_msj']=1;
            $_SESSION['error_remisiones']="El N&uacute;mero de Correlativo No Existe";	
            $url_relativa = "siscor/vista/consultar_respuesta_remisiones.php";
            header("Cache-Control: no-cache");
            header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
            exit;
        }
        else 
        {
        //si es el modulo de repuesta remisiones entra como diferente a 1 y asigna a $_sesscion['consul_ofico']=1
           //if ($_SESSION['RespuestaOfic']!=1 )
            //{
            //valida si el oficio fue mercado con amerita respuesta
            $existe=$Remisiones->ExisteRespuestaRemision('vista_mostrar_remisiones','cd_remisiones',$Remisiones->getId(),'nu_ano_remisiones',$Remisiones->getAnio_remision(),'cd_direcciones_usuarios',$Remisiones->getId_direcciones_user(),'cd_alto_nivel_usuarios',$Remisiones->getId_alto_nivel_user(),'cd_primer_nivel_usuarios',$Remisiones->getId_primer_nivel_user(),'in_responder_remisiones',"true");
            if(!$existe)
            {
                $_SESSION['estatus_msj']=1;
                $_SESSION['error_remisiones']="Este N&uacute;mero de Remisi&oacute;n No Amerita Respuesta";
                $url_relativa = "siscor/vista/consultar_respuesta_remisiones.php";
                header("Cache-Control: no-cache");
                header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
                exit;
            }// fin valida si el oficio fue mercado con amerita respuesta
            else
            {
            //valida si el oficio ya fue respondido
                $existe=$Remisiones->ExisteRespuestaRemision('vista_mostrar_respuesta_remisiones','cd_remisiones',$Remisiones->getId(),'nu_ano_remisiones',$Remisiones->getAnio_remision(),'cd_direcciones_usuarios',$Remisiones->getId_direcciones_user(),'cd_alto_nivel_usuarios',$Remisiones->getId_alto_nivel_user(),'cd_primer_nivel_usuarios',$Remisiones->getId_primer_nivel_user(),'in_responder_remisiones',"true");
                if($existe)
                {
                    //fin de modulo de respuesta oficio valor de consul_oficio	
                    $_SESSION['id_remisiones']=$Remisiones->getId();
                    $_SESSION['anio_remisiones']=$Remisiones->getAnio_remision();
                    $_SESSION['fecha_remision_carga']=$Remisiones->getFeremision();
                    $_SESSION['fecha_remision_carga']=$Remisiones->devuelve_fecha($_SESSION['fecha_remision_carga']);
                    $_SESSION['alto_nivel_seleccionado_remision']=$Remisiones->getAlto_nivel();
                    $_SESSION['primer_nivel_seleccionado_remision']=$Remisiones->getPrimer_nivel();
                 
                    $_SESSION['direcciones_seleccionado_remision']=$Remisiones->getDirecciones();
                    $_SESSION['Unidades_seleccionado_remision']=$Remisiones->getUnidad();
                    $_SESSION['Coordinaciones_seleccionado_remision']=$Remisiones->getCoordinaciones();
                    $_SESSION['nombre_responsable_remision']=$Remisiones->getResponsable();
                    $_SESSION['prioridades_seleccionado_remision']=$Remisiones->getPrioridad();
                    $_SESSION['accion_seleccionado_remision']=$Remisiones->getAcciones();
                    $_SESSION['check_amerita_respuesta_remision']=$Remisiones->getAmerita_remisiones();	
                    $_SESSION['observacion_remision']=$Remisiones->getObservaciones();
                    $_SESSION['check_r']=$Remisiones->getCheck_respondida_remision();
                    $_SESSION['respondida_observacion_remision']=$Remisiones->getRespondida_remision();
                    $_SESSION['id_remitir_remision']=$Remisiones->getId_recibidas();
                    $_SESSION['anio_remitir_remision']=$Remisiones->getAnio_recibidas();
                    $_SESSION['hora_remision']=$Remisiones->getHora();
                    $_SESSION['minuto_remision']=$Remisiones->getMinuto();
                    $_SESSION['tiempo_remision']=$Remisiones->getTiempo();
                    $_SESSION['fe_paralafirma']=$Remisiones->getFecha_paralafirma();
                    $_SESSION['fe_paralafirma']=$Remisiones->devuelve_fecha($_SESSION['fe_paralafirma']);
                    $_SESSION['fe_firmada']=$Remisiones->getFecha_firmado();
                    $_SESSION['fe_firmada']=$Remisiones->devuelve_fecha($_SESSION['fe_firmada']);
                    $_SESSION['fe_despachada']=$Remisiones->getFecha_despachado();	
                    $_SESSION['fe_despachada']=$Remisiones->devuelve_fecha($_SESSION['fe_despachada']);
                    $_SESSION['nb_recibidapor']=$Remisiones->getNombre_recibidapor();
                    $_SESSION['fecha_recibidapor_remisiones']=$Remisiones->getFecha_recibidapor();
                    $_SESSION['fecha_recibidapor_remisiones']=$Remisiones->devuelve_fecha($_SESSION['fecha_recibidapor_remisiones']);
                    $_SESSION['hh_recibidapor']=$Remisiones->getHora_recibidapor();
                    $_SESSION['mm_recibidapor']=$Remisiones->getMinuto_recibidapor();
                    $_SESSION['tt_recibidapor']=$Remisiones->getTiempo_recibidapor();
                    if($_SESSION['hh_recibidapor']== 0)
                    {
                        $_SESSION['hh_recibidapor']="";
                    }
                    if($_SESSION['mm_recibidapor']== 61)
                    {
                        $_SESSION['mm_recibidapor']="";
                    }                    
                    if($_SESSION['tt_recibidapor']== 0)
                    {
                        $_SESSION['tt_recibidapor']="--";
                    }                   
                    
              //      die($_SESSION['bloquear_ConsulRespuestaRemisiones']);

                    $_SESSION['ConsulRespuestaRemisiones']=1;				
                    $_SESSION['bloquear_ConsulRespuestaRemisiones']=1;

                    $RespuestaRemisiones= new RespuestaRemisiones();
                    $RespuestaRemisiones->setId_Remisiones($_SESSION['id_remisiones']);
                    $RespuestaRemisiones->setNuanio_remisiones($_SESSION['anio_remisiones']);
                    $RespuestaRemisiones->setId_alto_nivel_user($_SESSION['alto_nivel_user']);
                    $RespuestaRemisiones->setId_primer_nivel_user($_SESSION['primer_nivel_user']);
                    $RespuestaRemisiones->setId_direcciones_user($_SESSION['direcciones_user']);

                    $RespuestaRemisiones->CargarDatosRemisionesRecibidas();
                    $_SESSION['id_respuesta_remision']=$RespuestaRemisiones->getId_recibida();
                    $_SESSION['anio_respuesta_remision']=$RespuestaRemisiones->getNuanio_recibida();	

                    $tabla="vista_mostrar_prioridades";
                    $orden="nb_prioridades";
                    $sw=1;
                    $cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
                    //echo($cant); die;
                    if ( $cont != 0 ) 
                    {
                        //echo $General->Mostrar(0); die();
                        $_SESSION['cantidad'] = $cont;
                        //echo $General->Mostrar(0); die();
                        //se crea un arreglo donde se alogen los registros necesarios
                        $campoId=array();
                        $campoNombre=array();
                        $datos = $Remisiones->Mostrar(1,$tabla,$orden,$sw);
                        //Carga los registros
                        while ( $row=pg_fetch_array($datos) )
                        { 
                            array_push( $campoId , $row["cd_prioridades"] );	
                            array_push( $campoNombre , $row["nb_prioridades"] );				
                        }
                        //Prepara para la comunicacion
                        $_SESSION['campoIdPrioridades'] = $campoId;
                        $_SESSION['campoNombrePrioridades'] = $campoNombre;
                    }

                    //carga el combo de acciones
                    $tabla="vista_mostrar_acciones";
                    $orden="nb_acciones";
                    $sw=1;
                    $cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
                    //echo($cant); die;
                    if ( $cont != 0 ) 
                    {
                        //echo $General->Mostrar(0); die();
                        $_SESSION['cantidad_acciones'] = $cont;
                        //echo $General->Mostrar(0); die();
                        //se crea un arreglo donde se alogen los registros necesarios
                        $campoId=array();
                        $campoNombre=array();
                        $datos = $Remisiones->Mostrar(1,$tabla,$orden,$sw);
                        //Carga los registros
                        while ( $row=pg_fetch_array($datos) )
                        { 
                            array_push( $campoId , $row["cd_acciones"] );	
                            array_push( $campoNombre , $row["nb_acciones"] );				
                        }
                         //Prepara para la comunicacion
                        $_SESSION['campoIdAcciones'] = $campoId;
                        $_SESSION['campoNombreAcciones'] = $campoNombre;
                    }//fin de acciones

                    //llena combo de alto nivel
                    $tabla= "vista_mostrar_alto_nivel";
                    $orden="nb_alto_nivel";
                    
                    if ($_SESSION['primer_nivel_user']==329)
                    {
                        $sw=2;
                    }
                    else
                    {
                        $sw=0;
                    }
                    $cont = $Remisiones->Mostrar(0,$tabla,$orden,$sw);
                   // die("sql");
                    if ( $cont != 0 ) 
                    {
                        //echo $alto_nivel->Mostrar(0); die();
                        $_SESSION['cantidad_alto_nivel'] = $cont;
                        //echo $alto_nivel->Mostrar(0); die();
                        //se crea un arreglo donde se alogen los registros necesarios
                        $campoId=array();
                        $campoNombre=array();
                        $datos = $Remisiones->Mostrar(1,$tabla,$orden,$sw);
                            //Carga los registros
                        while ( $row=pg_fetch_array($datos) )
                            { 
                                array_push( $campoId , $row["cd_alto_nivel"] );	
                                array_push( $campoNombre , $row["nb_alto_nivel"] );				
                            }
                        //Prepara para la comunicacion
                        $_SESSION['campoIdAltoNivel'] = $campoId;
                        $_SESSION['campoNombreAltoNivel'] = $campoNombre;		
                    }//fin de llena combo de alto nivel

                    if ($Remisiones->getId_primer_nivel_user()!="")
                    {
                        if ($_SESSION['alto_nivel_user']==3)
                        {
                               // $valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
                                $valor="cd_alto_nivel=".$_SESSION['alto_nivel_user']." and cd_primer_nivel=".$_SESSION['primer_nivel_user']." or cd_primer_nivel_aux=".$_SESSION['primer_nivel_user'];	
                                $tabla= "vista_mostrar_primer_nivel";
                                $orden="nb_primer_nivel";                                   
                        }
                        else
                        {
                            if ($_SESSION['primer_nivel_user']==329)
                            {
                                if($_SESSION['alto_nivel_seleccionado_remision']==3)
                                {
                                    //$valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_seleccionado_remision'];
                                    $valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_seleccionado_remision']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
                                    $tabla= "vista_mostrar_primer_nivel_corres";
                                    $orden="nb_primer_nivel_corres";
                                }
                                else if($_SESSION['alto_nivel_seleccionado_remision']==2)
                                {
                                    $valor="cd_alto_nivel=2 and cd_primer_nivel < 144";
                                    $tabla= "vista_mostrar_primer_nivel";
                                    $orden="nb_primer_nivel";                                     
                                }
                                else
                                {
                                    $valor="cd_alto_nivel=".$_SESSION['alto_nivel_seleccionado_remision'];
                                    $tabla= "vista_mostrar_primer_nivel";
                                    $orden="nb_primer_nivel";                                       
                                }    
                            }
                            else
                            {
                                // $valor="cd_alto_nivel=".$_SESSION['alto_nivel_user'];
                                //$valor="cd_alto_nivel=".$_SESSION['alto_nivel_seleccionado_remision'];
                                $valor="cd_alto_nivel_corres=".$_SESSION['alto_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];	
                                $tabla= "vista_mostrar_primer_nivel_corres";
                                $orden="nb_primer_nivel_corres";
                                $_SESSION['alto_nivel_seleccionado_remision']=3;                                     
                            }
                        }
                        $cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
                        //echo($cant); die;
                        if ( $cont != 0 ) 
                        {
                            //echo $alto_nivel->Mostrar(0); die();
                            $_SESSION['cantidad_primer_nivel'] = $cont;
                            //echo $alto_nivel->Mostrar(0); die();
                            //se crea un arreglo donde se alogen los registros necesarios
                            $campoId=array();
                            $campoNombre=array();
                            $datos = $Remisiones->MostrarValores(1,$tabla,$orden,$valor);
                            //Carga los registros
                             while ($row=pg_fetch_array($datos))
                            { 
                                if($_SESSION['alto_nivel_seleccionado_remision']==3)
                                {             
                                    array_push( $campoId , $row["cd_primer_nivel_corres"] );	
                                    array_push( $campoNombre , $row["nb_primer_nivel_corres"] );				
                                }
                                else
                                {
                                    array_push( $campoId , $row["cd_primer_nivel"] );	
                                    array_push( $campoNombre , $row["nb_primer_nivel"] );				                            
                                }                                
                            }
                            //Prepara para la comunicacion
                            $_SESSION['campoIdprimer_nivel'] = $campoId;
                            $_SESSION['campoNombreprimer_nivel'] = $campoNombre;		
                        }
                    }//fin de combo para llenar primer_nivel

                    //combo para llenar direcciones
                    if ($_SESSION['direcciones_user']!="")
                    {
                            /*if ($_SESSION['direcciones_user']==0)
                            {
                                    $valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user'];	
                            }
                            else 
                            {
                                    $valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];		
                            }*/
                        if ($_SESSION['direcciones_user']==0){
                        //$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user'];	
                        $valor="cd_primer_nivel=".$_SESSION['primer_nivel_seleccionado_remision'];	
                        }
                        else 
                        {
                        $valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']; 		
                        //$valor="cd_primer_nivel=".$_SESSION['primer_nivel_user']." and cd_alto_nivel_usuarios=".$_SESSION['alto_nivel_user']." and cd_primer_nivel_usuarios=".$_SESSION['primer_nivel_user']." and cd_direcciones_usuarios=".$_SESSION['direcciones_user'];
                        }
                        //die("$valor");
                        $tabla= "vista_mostrar_direcciones";
                        $orden="nb_direcciones";
                        $cont = $Remisiones->MostrarValores(0,$tabla,$orden,$valor);
                        //echo($cant); die;
                        if ( $cont != 0 ) 
                        {
                            //echo $alto_nivel->Mostrar(0); die();
                            $_SESSION['cantidaddirecciones'] = $cont;
                            //echo $alto_nivel->Mostrar(0); die();
                            //se crea un arreglo donde se alogen los registros necesarios
                            $campoId=array();
                            $campoNombre=array();
                            $datos = $Remisiones->MostrarValores(1,$tabla,$orden,$valor);
                            //Carga los registros
                            while ( $row=pg_fetch_array($datos) )
                            { 
                                array_push( $campoId , $row["cd_direcciones"] );	
                                array_push( $campoNombre , $row["nb_direcciones"] );				
                            }
                                //Prepara para la comunicacion
                                $_SESSION['campoIddirecciones'] = $campoId;
                                $_SESSION['campoNombredirecciones'] = $campoNombre;		
                        }

                    }

                    if ($_SESSION['direcciones_user']!=0)
                    {
                        $tabla="vista_mostrar_unidades";
                        $orden="nb_unidades";
                        $where="where cd_direcciones=".$_SESSION['direcciones_user']."";
                        $cont = $Remisiones->MostrarUnidades(0,$tabla,$orden,$where);
                        //echo($cant); die;
                        if ( $cont != 0 ) 
                        {
                            //echo $General->Mostrar(0); die();
                            $_SESSION['cantidadUnidades'] = $cont;
                            //echo $General->Mostrar(0); die();
                            //se crea un arreglo donde se alogen los registros necesarios
                            $campoId=array();
                            $campoNombre=array();
                            $datos = $Remisiones->MostrarUnidades(1,$tabla,$orden,$where);
                            //Carga los registros
                            while ( $row=pg_fetch_array($datos) )
                            { 
                                    array_push( $campoId , $row["cd_unidades"] );	
                                    array_push( $campoNombre , $row["nb_unidades"] );				
                            }
                          //Prepara para la comunicacion
                            $_SESSION['campoIdUnidades'] = $campoId;
                            $_SESSION['campoNombreUnidades'] = $campoNombre;
                        }
                    }

                    if ($_SESSION['Unidades_seleccionado_remision']!=0)
                    {
                        $tabla="vista_mostrar_coordinaciones";
                        $orden="nb_coordinaciones";
                        $where="where cd_unidades=".$_SESSION['Unidades_seleccionado_remision']."";
                        $cont = $Remisiones->MostrarUnidades(0,$tabla,$orden,$where);
                        //echo($cant); die;
                        if ( $cont != 0 ) 
                        {
                            //echo $General->Mostrar(0); die();
                            $_SESSION['cantidadCoordinaciones'] = $cont;
                            //echo $General->Mostrar(0); die();
                            //se crea un arreglo donde se alogen los registros necesarios
                            $campoId=array();
                            $campoNombre=array();
                            $datos = $Remisiones->MostrarUnidades(1,$tabla,$orden,$where);
                            //Carga los registros
                            while ( $row=pg_fetch_array($datos) )
                            { 
                                    array_push( $campoId , $row["cd_coordinaciones"] );	
                                    array_push( $campoNombre , $row["nb_coordinaciones"] );				
                            }
                            //Prepara para la comunicacion
                            $_SESSION['campoIdCoordinaciones'] = $campoId;
                            $_SESSION['campoNombreCoordinaciones'] = $campoNombre;    	
                        }	
                    }
                }// fin valida si el oficio ya fue respondido
                else 
                {
                    //valida si el oficio ya fue respondido para poder modificarlo	
                    //if ($_SESSION['ConsultarRespuesta']==1)
                    //{
                        $_SESSION['estatus_msj']=1;
                        unset($_SESSION['ConsultarRespuesta']);
                        $_SESSION['error_remisiones']="Este N&uacute;mero de Oficio no se le ha asignado una Respuesta";
                        $url_relativa = "siscor/vista/consultar_respuesta_remisiones.php?Resp_ofi=cons";	
                        header("Cache-Control: no-cache");
                        header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
                        exit;					
                    //}//fin valida si el oficio ya fue respondido para poder modificarlo
                    /*else
                      {
                            $_SESSION['consul_oficio']=1;	
                      }*/
	
                }
            }//cierra el else
        //}   	
        $url_relativa = "siscor/vista/registrar_remisiones.php";
        header("Cache-Control: no-cache");
        header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
        exit;
        }//fin de combo para llenar primer_nivel
    }

    $url_relativa = "siscor/vista/consultar_respuesta_remisiones.php";
    header("Cache-Control: no-cache");
    header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);	
}
else
{
    $_SESSION['estatus_msj']=1;
    $_SESSION['error_autorizacion']="Usted no esta autorizado para realizar esta acción";	
    $url_relativa = "siscor/vista/menu_principal.php";
    header("Cache-Control: no-cache");
    header("Location: http://" . $_SERVER['HTTP_HOST']  . "/" .$url_relativa);
}