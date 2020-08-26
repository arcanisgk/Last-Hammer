<?php
class Class_Pro
{
    public function Events()
    {
        $event      = CORE::$ObjVar['SIS']['StrucProcess'][1];
        $Show       = false;
        $Refresh    = false;
        $In         = false;
        $Nav        = false;
        $msgDisplay = '';
        $msgEMAIL   = '';
        $msgNOT     = '';
        $DataMail   = [];
        $DataMail   = CORE::$ObjClass['GEN']['MAILMANAGER']->InitMail();
        $CDate      = CORE::$ObjClass['GEN']['DATEMANAGER']->GenDate('A');
        $CUser      = $_SESSION['Id_User'];
        switch ($event) {
            case 'save':
                try {
                    //Analisis de Datos en $_POST
                    foreach ($_POST as $key => $value) {
                        ${$key} = trim(addslashes(strip_tags($value)));
                    }
                    //Analisis del Script php para el Guardado de Registro
                    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

                    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                    // envio por Email
                    $msgDisplay        = '<br>Se a Guardado Correctamente los datos:<br>'.$msgDisplay;
                    $msgEMAIL          = 'Se a Generado un Nuevo Regitros de BLAH BLAH BLAH BLAH: ';
                    $DataMail['SEND']  = true;
                    $DataMail['2Mail'] = [$Email => $Username];
                    $DataMail['prio']  = true;
                    $DataMail['subj'] .= 'Se ha Creado un BLAH BLAH BLAH BLAH.';
                    $DataMail['cont'] .= $msgEMAIL;
                    $DataMail['type']  = 2;
                    $DataMail['track'] = CORE::$ObjClass['GEN']['MAILMANAGER']->SendMail($DataMail);
                    //Salida por pantalla
                    $msgDisplay .= $DataMail['track']['SMG'];
                    $Show    = true;
                    $In      = 6;
                    $Refresh = false;
                    $Nav     = true;
                } catch (Exception $e) {
                    CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
                    CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
                }
                break;
            case 'consult': //Evento
                try {
                    //Analisis de Datos en $_POST
                    foreach ($_POST as $key => $value) {
                        ${$key} = CORE::$ObjClass['GEN']['VARSMANAGER']->GetCleanPOST(['key' => $key, 'value' => $value]);
                    }
                    //Analisis del Script php para el Consulta de Registro
                    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

                    //*********************Observacion**********************
                    //--->Las variables que Inician con: $p_s_ Provienen de una conulsta on click o on select.
                    //--->Las variables: $input_search Provienen de una conulsta en el CRUD.
                    //---> Se Debe Hacer el Desarrollo entorno a que variable tiene datos y para la Consulta.

                    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                    // envio por Email
                    $msgDisplay = 'Datos de la Consulta Regresados al cliente';
                    $Show       = true;
                    $In         = 'f-NNN-0000';
                    $Refresh    = false;
                    $Nav        = false;
                } catch (Exception $e) {
                    CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
                    CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
                }
                break;
            case 'update':
                try {
                    //Analisis de Datos en $_POST
                    foreach ($_POST as $key => $value) {
                        ${$key} = trim(addslashes(strip_tags($value)));
                    }
                    //Analisis del Script php para el Actualizar Registros
                    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

                    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
                    // envio por Email
                    $msgDisplay        = '<br>Se a Actualizado Correctamente los datos:<br>'.$msgDisplay;
                    $msgEMAIL          = 'Se han Actualizado un Regitros de BLAH BLAH BLAH BLAH: ';
                    $DataMail['SEND']  = true;
                    $DataMail['2Mail'] = [$Email => $Username];
                    $DataMail['prio']  = true;
                    $DataMail['subj'] .= 'Se ha Actualizado un BLAH BLAH BLAH BLAH.';
                    $DataMail['cont'] .= $msgEMAIL;
                    $DataMail['type']  = 2;
                    $DataMail['track'] = CORE::$ObjClass['GEN']['MAILMANAGER']->SendMail($DataMail);
                    //Salida por pantalla
                    $msgDisplay .= $DataMail['track']['SMG'];
                    $Show    = true;
                    $In      = 6;
                    $Refresh = false;
                    $Nav     = true;
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
