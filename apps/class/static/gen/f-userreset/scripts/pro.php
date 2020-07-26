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
            case 'update':
                try {
                    $CurDate     = CORE::$ObjClass['GEN']['DATEMANAGER']->GenDate('A');
                    $email_reset = $_POST['i_text_email_reset'];
                    $UserData    = CORE::$ObjClass['GEN']['USERMANAGER']->GetUserDataByMail($email_reset);
                    if (null == $UserData) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("No encontramos un usuario con el correo que usuaste, debes usar un correo de la empresa.");
                    }
                    $newpass           = CORE::$ObjClass['GEN']['CRIPTMANAGER']->Default_Password();
                    $Crippass          = CORE::$ObjClass['GEN']['CRIPTMANAGER']->Encript_Password($newpass);
                    $Query             = [];
                    $Query[DBSYS][]    = "UPDATE Tbl_Sys_Usuarios SET Password='".$Crippass."', PasswordT='', FUpdPass=1, DateUP='".$CurDate."' WHERE Email='".$email_reset."';";
                    $BDResult          = CORE::$ObjClass['GEN']['DBMANAGER']->SetData($Query);
                    $msgDisplay        = 'El sistema te ha generado una nueva Contraseña; por seguridad la contraseña fue enviada a tu Correo.<br>Esta Contraseña debes Cambiarla cuando entres y colocar una de tu preferencia.';
                    $msgEMAIL          = 'El sistema te ha generado una nueva Contraseña; ya que la solicitaste.<br>Esta Contraseña debes Cambiarla cuando entres y colocar una de tu preferencia.<br><br>Contraseña: <b>'.$newpass.'</b>';
                    $DataMail['SEND']  = true;
                    $DataMail['2Mail'] = [$UserData['Email'] => $UserData['Username']];
                    $DataMail['prio']  = true;
                    $DataMail['subj'] .= 'Solicitud de Recuperacion de Contraseña.';
                    $DataMail['cont'] .= $msgEMAIL;
                    $DataMail['type'] = 3;
                    CORE::$ObjClass['GEN']['MAILMANAGER']->SendMail($DataMail);
                    $Show    = true;
                    $Refresh = true;
                    $In      = 6;
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
