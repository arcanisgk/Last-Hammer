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
                    if (!$_POST['checkbox1']) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("No encontramos Cambios a Realizar.");
                    }
                    if ($_POST['oldpass'] == $_POST['newpass']) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("La Contraseña anterior es igual a la nueva, Verfica los datos que quieres ingresar.");
                    }
                    $UserData = CORE::$ObjClass['GEN']['USERMANAGER']->GetUserDataByID($_SESSION['Id_User']);
                    $CurDate  = CORE::$ObjClass['GEN']['DATEMANAGER']->GenDate('A');
                    if (password_verify($_POST['newpass'], $UserData['Password'])) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("La Contraseña usada es igual a la Que esta Guardada en el Sistema.");
                    }
                    $Crippass          = CORE::$ObjClass['GEN']['CRIPTMANAGER']->Encript_Password($_POST['newpass']);
                    $Query[DBSYS][]    = "UPDATE Tbl_Sys_Usuarios SET Password='".$Crippass."', PasswordT='', ACCToken=0,DatToken='".$CurDate."', FUpdPass=0, DateUP='".$CurDate."' WHERE IdTUser='".$_SESSION['Id_User']."';";
                    $BDResult          = CORE::$ObjClass['GEN']['DBMANAGER']->SetData($Query);
                    $msgDisplay        = 'Se ha cambiado correctamente la contraseña.<br>';
                    $DataMail['SEND']  = true;
                    $DataMail['2Mail'] = [$_SESSION['Email'] => $_SESSION['Username']];
                    $DataMail['prio']  = true;
                    $DataMail['subj'] .= 'Actualización de Perfil/Cambio de Contraseña Realizado.';
                    $DataMail['cont'] .= $msgDisplay;
                    $DataMail['type'] = 2;
                    CORE::$ObjClass['GEN']['MAILMANAGER']->SendMail($DataMail);
                    CORE::$ObjClass['GEN']['USERMANAGER']->ForceLogout();
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
