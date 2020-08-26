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
                    $CurDate  = CORE::$ObjClass['GEN']['DATEMANAGER']->GenDate('A');
                    $UserData = CORE::$ObjClass['GEN']['USERMANAGER']->GetUserDataByNick($_SESSION['Username']);
                    if (null == $UserData) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("No encontramos un usuario con el Nick (Username) que Usuaste, debes usar uno Correcto.");
                    }
                    $re1pass = $_POST['re1pass'];
                    $re2pass = $_POST['re2pass'];
                    if (strlen($re1pass) < 8) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("La Contraseña debe tener más de 8 Caracteres (Letras).");
                    }
                    if (strlen($re2pass) < 8) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("La Contraseña debe tener más de 8 Caracteres (Letras).");
                    }
                    if ($re1pass !== $re2pass) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("La Contraseña usada para el cambio no son iguales.");
                    }
                    if (password_verify($re1pass, $UserData['Password'])) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("La Contraseña usada es igual a la anterior.");
                    }
                    if (password_verify($re2pass, $UserData['Password'])) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("La Contraseña usada es igual a la anterior.");
                    }
                    $Crippass          = CORE::$ObjClass['GEN']['CRIPTMANAGER']->Encript_Password($re1pass);
                    $Query[DBSYS][]    = "UPDATE Tbl_Sys_Usuarios SET Password='".$Crippass."', PasswordT='',ACCToken=0, DatToken='".$CurDate."', FUpdPass=0, DateUP='".$CurDate."' WHERE IdTUser='".$_SESSION['Id_User']."';";
                    $BDResult          = CORE::$ObjClass['GEN']['DBMANAGER']->SetData($Query);
                    $msgDisplay        = 'Se ha cambiado correctamente la contraseña.<br>';
                    $DataMail['SEND']  = true;
                    $DataMail['2Mail'] = [$_SESSION['Email'] => $_SESSION['Username']];
                    $DataMail['prio']  = true;
                    $DataMail['subj'] .= 'Cambio de Contraseña Realizado.';
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
