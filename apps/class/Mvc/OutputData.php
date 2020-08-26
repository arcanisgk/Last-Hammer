<?php

namespace IcarosNet\LastHammer\Mvc;
use CoreApp;

class OutputData
{
    private static $instance = null;

    public static function _getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function showEvent()
    {
        try {
            /*
				//Como mostrar datos por pantalla correctamente al Ejecutar un Evento (no navegacion):
				//Se requieren las siguientes variables dentro de un Grupo llamado G1:
				//Indica un valor booleano como control para mostrar por pantalla la salida.
				CORE::$ObjVar['EVENT']['SHOW']

				//Indica el Target donde se mostrar:
				f-gen-0110 dentro del formulario, por defecto aquel elemento con tag class = ".formContent".
				Console: mostrara los datos en la consola de javascript. (solo para desarrollo).
				Numérico de 0 a 6: Mara ser mostrado en modals; el sistema analizara si el número dinámico del modal no está ocupado.
				Los numeros usados de 0 a 6 Se emplearan de la siguiente forma:

				0: Error de Sistema
				1: Error del Usuario (Control del Formulario/Evento, Datos faltantes para completar el evento)
				2: No Usado el evento se trata de la ejecucion Interna del Cron.
				3: No Usado el Sistema se trata de un Error de Envio de Correo el cual solo se hace tracking por Log y se deja ver en la salida por pantalla del usuario en la ejecucion del evento.
				4: Indica que existe un error de comunicacion (FTP o Web Service).
				5: Salida de Datos por Defecto de Errores no Documentados.
				6: Ejecucion correcta.

				CORE::$ObjVar['EVENT']['TARGET']

				//Donde Almacenaremos el contenido resultado HTML:
				CORE::$ObjVar['DISPLAY']['HTML']['DATA']

				//si queremos que el sistema se refresque emitimos un valor Booleano.
				CORE::$ObjVar['EVENT']['REFRESH']

				//si queremos que el sistema automáticamente navegue al mismo formulario,
				//el refresh anterior debe ser false y se debe pasar un nuevo parámetro booleano true.
				CORE::$ObjVar['EVENT']['NAV']

				//Si queremos mostrar Otros contenidos tendremos que anidar más grupos G1, G2, G3, G4 G5;
				//Estos datos solo podrán ser de uso informativo y solo podrán contener dos variables.
				CORE::$ObjVar['EVENT']['G1']['DATA']

				//Conociendo los Parámetros y Controles Para la Gestión de Datos por Pantalla,
				//Ahora veremos cómo se agrupan para ser enviados a la Pantalla:
				//(el sistema analiza los datos y genera esta estructura de manera automática)
				//(Sin salida por pantalla con refresh automático)
				$toClient = ['show' => false, 'in' => '', 'data' => '', 'ref' => true, 'nav' => true];

				//(Dentro del formulario)
				$toClient = ['show' => true, 'in' => 'f-gen-0110', 'data' => $html, 'ref' => false, 'nav' => true];

				//(Dentro de un Modal de Error)
				$toClient = ['show' => true, 'in' => 0, 'data' => $html, 'ref' => false, 'nav' => false];

				//(Dentro de un Modal de Resultado)
				$toClient = ['show' => true, 'in' => 1, 'data' => $html, 'ref' => false, 'nav' => false];

				//(Dentro de un Modal de Resultado con refresh de Sistema)
				$toClient = ['show' => true, 'in' => 1, 'data' => $html, 'ref' => true, 'nav' => false];

				//(Dentro de un Modal de Resultado con navegación al mismo formulario)
				$toClient = ['show' => true, 'in' => 1, 'data' => $html, 'ref' => false, 'nav' => true];

				//Anidar más Contenido en que saldrá en otros modal tipo informativo:

				$addMore = ['G1']['in' => 1, 'data' => $html];

				$toClient = array_merge($toClient, $addMore);

				$addMore = ['G2']['in' => 1, 'data' => $html];

				$toClient = array_merge($toClient, $addMore);

				Pasamos entonces al Analisis de Datos de salida por pantalla de un evento (no navegacion).
			*/

            $show = (true !== CoreApp::$ovars['EVENT']['SHOW'] ? false : CoreApp::$ovars['EVENT']['SHOW']);
            $in   = (null === CoreApp::$ovars['EVENT']['IN'] ? '0' : CoreApp::$ovars['EVENT']['IN']);
            $ref  = (true !== CoreApp::$ovars['EVENT']['REFRESH'] ? false : CoreApp::$ovars['EVENT']['REFRESH']);
            $nav  = (true !== CoreApp::$ovars['EVENT']['NAV'] ? false : CoreApp::$ovars['EVENT']['NAV']);
            $data = (null == CoreApp::$ovars['DISPLAY']['HTML']['DATA'] ? 'No data to display' : CoreApp::$ovars['DISPLAY']['HTML']['DATA']);
            $json = (true !== CoreApp::$ovars['DISPLAY']['HTML']['OUTJSON'] ? false : CoreApp::$ovars['DISPLAY']['HTML']['OUTJSON']);
            $data = CoreApp::$oclass['MVC']['LANG']->getTranslation($data);
            if (!$json) {
                $data = \IcarosNet\LastHammer\Gen\Vars::_getInstance()->scapeQuote2Json($data);
            }
            $to_client   = ['show' => $show, 'in' => $in, 'data' => $data, 'ref' => $ref, 'nav' => $nav];
            $is_formated = \IcarosNet\LastHammer\Gen\Vars::_getInstance()->evalArray2JSON($to_client);
            $last_terror = error_get_last();
            $any_header  = headers_sent();
            if (true == $is_formated && null == $last_terror && !$any_header) {
                $out_result = json_encode($to_client);
                header('Content-type: application/json');
                echo $out_result;
            }
            /*
            $data = CORE::$ObjClass['GEN']['VARSMANAGER']->ScapeQuote2Json($data);

            $toClient = ['show' => $show, 'in' => $in, 'data' => $data, 'ref' => $ref, 'nav' => $nav];
            $count    = 1;
            $iModal   = 100;
            $addMore  = [];

            while ($count <= 5) {
                if (isset(CORE::$ObjVar['EVENT']['G'.$count])) {
                    $data                  = CORE::$ObjVar['EVENT']['G'.$count]['DATA'];
                    $addMore['G'.$count] = ['in' => $iModal, 'data' => $data];
                    $toClient              = array_merge($toClient, $addMore);
                }
                ++$count;
                ++$iModal;
            }

            $isFormated = CORE::$ObjClass['GEN']['VARSMANAGER']->CheckIfArr2JSON($toClient);
            $lasterror  = error_get_last();
            $anyHeader  = headers_sent();
            if (true == $isFormated && null == $lasterror && !$anyHeader) {
                $outresult = json_encode($toClient);
                header('Content-type: application/json');
                echo $outresult;
            } else {
                CORE::$ObjClass['GEN']['VARSMANAGER']->VarExport_C($lasterror);
            }*/
        } catch (Exception $e) {
            #CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
            #CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
        }
    }

    public function showOutput($output)
    {
        if (1 == $output) {
            $html = [];
            foreach (CoreApp::$ovars['DISPLAY']['TOBROWSER'] as $key => $value) {
                $html[] = CoreApp::$oclass['MVC']['LANG']->getTranslation($value);
            }
            $htmlOutput = '';
            if (true == CoreApp::$ovars['DISPLAY']['HTML']['OUTJSON']) {
                header('Content-type: application/json; charset=utf-8');
                $htmlOutput = json_encode($html, JSON_FORCE_OBJECT);
            } else {
                $htmlOutput = implode($html);
            }
            $lasterror = error_get_last();
            $anyHeader = headers_sent();
            if (null == $lasterror && !$anyHeader) {
                echo $htmlOutput;
            } else {
                \IcarosNet\LastHammer\Gen\Vars::_getInstance()->VarExport_C($lasterror);
            }
        }
    }
}
