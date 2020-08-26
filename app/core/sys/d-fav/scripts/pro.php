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
            case 'addfav':
                try {
                    foreach ($_POST as $key => $value) {
                        ${$key} = CORE::$ObjClass['GEN']['VARSMANAGER']->GetCleanPOST(['key' => $key, 'value' => $value]);
                    }
                    $Query        = [];
                    $Query[DBSYS] = "SELECT * FROM Tbl_Sys_UserFav WHERE IdUserFav='".$_SESSION['Id_User']."';";
                    $BDResult     = CORE::$ObjClass['GEN']['DBMANAGER']->GetData($Query);
                    if ($BDResult['c'] > 9) {
                        throw new Exception("Vaya tienes muchos accesos directo, si quieres agregar mas debes eliminar alguno de los que ya tienes.");
                    }
                    $Query[DBSYS] = "SELECT * FROM Tbl_Sys_PerfilProceso WHERE ProcessCod='".$formAct."';";
                    $BDResult     = CORE::$ObjClass['GEN']['DBMANAGER']->GetData($Query);
                    if (0 == $BDResult['c']) {
                        throw new Exception("Vaya este Proceso no se puede agregar a los Favoritos ya que necesita permisos de Super Usuario.");
                    } else {
                        $row = $BDResult['r'];
                    }
                    $Query          = [];
                    $Query[DBSYS][] = "INSERT INTO Tbl_Sys_UserFav(IdUserFav,ProcessCod, ProcessName) VALUES ('".$_SESSION['Id_User']."','".$formAct."','".$row['ProcessMenu']."');";
                    $BDResult       = CORE::$ObjClass['GEN']['DBMANAGER']->SetData($Query);
                    if (true == $BDResult['r']) {
                        $msgDisplay .= '<br><br>'.$BDResult['T'];
                    }
                    $msgDisplay = 'Se a agregado el favorito correctamente.'.$msgDisplay;
                    $Show       = true;
                    $In         = 6;
                    $Refresh    = true;
                    $Nav        = false;
                } catch (Exception $e) {
                    CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
                    CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
                }
                break;
            case 'remfav':
                try {
                    foreach ($_POST as $key => $value) {
                        ${$key} = CORE::$ObjClass['GEN']['VARSMANAGER']->GetCleanPOST(['key' => $key, 'value' => $value]);
                    }
                    $Query[DBSYS][] = "DELETE FROM Tbl_Sys_UserFav WHERE IdUserFav='".$_SESSION['Id_User']."' AND ProcessCod='".$formAct."';";
                    $BDResult       = CORE::$ObjClass['GEN']['DBMANAGER']->DeleteData($Query);
                    if (true == $BDResult['r']) {
                        $msgDisplay .= '<br><br>'.$BDResult['T'];
                    }
                    $msgDisplay = 'Se a Eliminado el favorito correctamente.'.$msgDisplay;
                    $Show       = true;
                    $In         = 6;
                    $Refresh    = true;
                    $Nav        = false;
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
