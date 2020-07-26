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
            case 'logout':
                try {
                    $CurDate        = CORE::$ObjClass['GEN']['DATEMANAGER']->GenDate('A');
                    $Query          = [];
                    $Query[DBSYS][] = "UPDATE Tbl_Sys_Usuarios SET ACCToken=0,DatToken='".$CurDate."' WHERE IdTUser='".$_SESSION['Id_User']."';";
                    $BDResult       = CORE::$ObjClass['GEN']['DBMANAGER']->SetData($Query);
                    if (isset($_SESSION)) {
                        $Cont = CORE::$ObjClass['GEN']['LOGSMANAGER']->LogEventBuild();
                        CORE::$ObjClass['GEN']['LOGSMANAGER']->LogEventSet($Cont, 'user');
                    }
                    CORE::$ObjClass['GEN']['USERMANAGER']->ForceLogout();
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
