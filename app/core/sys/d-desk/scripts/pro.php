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
            case 'save':
                try {
                    foreach ($_POST as $key => $value) {
                        ${$key} = CORE::$ObjClass['GEN']['VARSMANAGER']->GetCleanPOST(['key' => $key, 'value' => $value]);
                        CORE::$ObjClass['GEN']['VARSMANAGER']->VarExport($key, '->', $value);
                    }
                    CORE::$ObjClass['GEN']['VARSMANAGER']->VarExport_C('Prueba Desktop');
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
