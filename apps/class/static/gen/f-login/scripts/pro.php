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
            case 'login':
                try {
                    if (isset($_SESSION['Id_User'])) {
                        throw new Exception("Hola, se ha Detectado que el usuario ya esta logeado, no te preocupes intentalo nuevamente.");
                    }
                    $UserData = [];
                    $username = $_POST['i_text_username'];
                    $password = $_POST['i_password'];
                    $UserData = CORE::$ObjClass['GEN']['USERMANAGER']->GetUserDataByNick($username);
                    if (null == $UserData) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("Hola, se ha Detectado que el usuario No Existe.");
                    }
                    if (0 == $UserData['ActSys']) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("Hola, se ha Detectado que el usuario No Se ha Activado por Tecnología.");
                    }
                    /*
                if ($UserData['ACCToken'] == 1) {
                $Query                                = [];
                $Query[DBSYS][]                       = "UPDATE Tbl_Sys_Usuarios SET ACCToken=0 WHERE IdTUser='" . $UserData['IdTUser'] . "';";
                $BDResult                             = CORE::$ObjClass['GEN']['DBMANAGER']->SetData($Query);
                CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                //throw new Exception("Hola, se ha Detectado que el usuario ya está en línea, o no cerro la Sesión correctamente, vuelva a Intentarlo.");
                }
                 */
                    if (!password_verify($password, $UserData['Password'])) {
                        CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 1;
                        throw new Exception("Hola, la Contraseña ".$password." es Incorrecta, vuelva a Intentarlo.<br>En tal caso no recuerdes la contraseña puedes recuperarla.");
                    }
                    $_SESSION['UserLogin']    = '1';
                    $_SESSION['UserLoginSTT'] = true;
                    $_SESSION['Id_User']      = $UserData['IdTUser'];
                    $_SESSION['Username']     = $UserData['Username'];
                    $_SESSION['Email']        = $UserData['Email'];
                    if ('1' == $UserData['S_U']) {
                        $_SESSION['S_U'] = true;
                    } else {
                        $_SESSION['S_U'] = false;
                    }
                    $_SESSION['TUser_DateCR']   = $UserData['DateCR'];
                    $_SESSION['TUser_DateUP']   = $UserData['DateUP'];
                    $_SESSION['TUser_DatToken'] = $UserData['DatToken'];
                    $_SESSION['Access']         = CORE::$ObjClass['GEN']['USERMANAGER']->GetPermisons();
                    $CurDate                    = CORE::$ObjClass['GEN']['DATEMANAGER']->GenDate('A');
                    $Query                      = [];
                    $Query[DBSYS][]             = "UPDATE Tbl_Sys_Usuarios SET ACCToken=1,DatToken='".$CurDate."' WHERE IdTUser='".$UserData['IdTUser']."';";
                    $BDResult                   = CORE::$ObjClass['GEN']['DBMANAGER']->SetData($Query);
                    if (1 == $UserData['FUpdPass']) {
                        $_SESSION['FUpdPass'] = true;
                        $msgDisplay           = 'Usted ha Iniciado Sesión correctamente.<br>Se detecto que usted debe cambiar la Contraseña.<br>Será Redirigido a la mesa de Control del Sistema.<br>';
                        $Show                 = true;
                        $In                   = 6;
                    }
                    $Refresh = true;
                } catch (Exception $e) {
                    CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
                    CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
                    CORE::$ObjClass['GEN']['SESSIONMANAGER']->Ses_Dest();
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
        $Cont = CORE::$ObjClass['GEN']['LOGSMANAGER']->LogEventBuild();
        CORE::$ObjClass['GEN']['LOGSMANAGER']->LogEventSet($Cont, 'user');
        CORE::$ObjVar['EVENT']['SHOW']    = $Show;
        CORE::$ObjVar['EVENT']['IN']      = $In;
        CORE::$ObjVar['EVENT']['REFRESH'] = $Refresh;
        CORE::$ObjVar['EVENT']['NAV']     = $Nav;
        if (false !== $Show) {
            CORE::$ObjVar['DISPLAY']['HTML']['DATA'] = $msgDisplay;
        }
    }
}
