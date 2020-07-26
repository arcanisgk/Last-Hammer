<?php
class Class_Pro
{
    public function Events()
    {
        $event = CORE::$ObjVar['SIS']['StrucProcess'][1];
        /*
			if (isset($process[2])) {$search = $process[2]; #Sub-Busqueda}
		*/
        $Show       = false;
        $Refresh    = false;
        $In         = false;
        $Nav        = false;
        $msgDisplay = '';
        $msgEMAIL   = '';
        $msgNOT     = '';
        $DataMail   = [];
        $DataMail   = CORE::$ObjClass['GEN']['MAILMANAGER']->InitMail();
        switch ($event) {
            case 'report':
                try {
                    $CurDate = CORE::$ObjClass['GEN']['DATEMANAGER']->GenDate('G', 'es');
                    $msgEMAIL .= '<b>Este es un mensaje de error.<br>';
                    $msgEMAIL .= 'Fecha de Reporte: '.$CurDate.' </b><br>';
                    if (isset($_SESSION['UserLoginSTT'])) {
                        if (true == $_SESSION['UserLoginSTT']) {
                            $msgEMAIL .= '<b>Usuario:</b> '.$_SESSION['Username'].'<br>';
                            $msgEMAIL .= '<b>ID:</b> '.$_SESSION['Id_User'].'<br>';
                        }
                    }
                    if (isset($_POST['t_comment'])) {
                        if ($_POST['t_comment']) {
                            $msgEMAIL .= '<br><b>Comentarios del Usuario:</b>'.$_POST['t_comment'];
                        } else {
                            $msgEMAIL .= '<br><b>Comentarios del Usuario: </b> El Usuario no ha Dejado Comentarios, Indicaciones o Instrucciones para replicar el error';
                        }
                    }
                    #Analisis de Imagenes
                    $msgEMAIL .= '<b>Imagen del Error:</b><br><br>';
                    $GroupImage = '';
                    #As Files
                    /*
				foreach ($_FILES as $key => $value) {
					$file              = [];
					$file['fname']     = $value['name'];
					$file['type']      = pathinfo($value['name'], PATHINFO_EXTENSION); # envia archivo del path
					$file['data']      = '';
					$file['path']      = $value['tmp_name'];
					$DataMail['add'][] = $file;
				}*/
                    #As String in Content
                    foreach ($_FILES as $key => $value) {
                        $path = $value['tmp_name'];
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $src  = 'data:image/'.$type.';base64,'.base64_encode($data);
                        $GroupImage .= '<img href="'.$src.'" src="'.$src.'"/>';
                    }
                    $msgEMAIL .= $GroupImage;
                    $msgEMAIL .= '<br><b>Nota:</b><br> Es importante que el usuario indique que estaba haciendo exactamente en el sistema antes de que saliera el mensaje.<br>
								Este error fue guardado en el log de errores, se ha enviado este correo para notificar a los Responsables del Sistema.';
                    $DataMail['SEND']  = true;
                    $DataMail['2Mail'] = MSUPPORT;
                    if (isset($_SESSION['UserLoginSTT'])) {
                        if (true == $_SESSION['UserLoginSTT']) {
                            $UserData        = CORE::$ObjClass['GEN']['USERMANAGER']->GetUserDataByNick($_SESSION['Username']);
                            $DataMail['2Cc'] = [$UserData['Username'] => $UserData['Email']];
                        }
                    }
                    $DataMail['prio'] = true;
                    $DataMail['subj'] .= 'Reporte de Bug o Error.';
                    $DataMail['cont'] .= $msgEMAIL;
                    $DataMail['type']  = 3;
                    $DataMail['track'] = CORE::$ObjClass['GEN']['MAILMANAGER']->SendMail($DataMail);
                    if (false == $DataMail['track']['state']) {
                        throw new Exception('El Reporte <b>No</b> se ah enviado Correctamente, comuníquese con IT Vía Telefónica.<br>'.$DataMail['track']['SMG']);
                    } else {
                        $msgDisplay = 'Reporte enviado Correctamente.';
                        $Show       = true;
                        $In         = 6;
                        $Refresh    = true;
                    }
                } catch (Exception $e) {
                    CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
                    CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
                }
                break;
            default:
                try {
                    CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 0;
                    throw new Exception("El proceso solicitado para el análisis de datos no existe o no se ha programado.");
                } catch (Exception $e) {
                    CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
                    CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
                }
                break;
        }
        CORE::$ObjVar['EVENT']['SHOW']    = $Show;
        CORE::$ObjVar['EVENT']['IN']      = $In;
        CORE::$ObjVar['EVENT']['REFRESH'] = $Refresh;
        CORE::$ObjVar['EVENT']['NAV']     = $Nav;
        if (false !== $Show) {
            CORE::$ObjVar['DISPLAY']['HTML']['DATA'] = $msgDisplay;
        }
    }
}
