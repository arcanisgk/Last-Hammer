<?php
class ClassOutputdataManager
{
    private static $instance = null;

    public static function _getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /*
	public function ShowHTML() {
		$html = [];
		foreach (CORE::$ObjVar['DISPLAY']['TOBROWSER'] as $key => $value) {
			$html[] = CORE::$ObjClass['MVC']['LANG']->GetTranslation($value);
		}
		$htmlOutput = '';
		if (CORE::$ObjVar['DISPLAY']['HTML']['OUTJSON'] == true) {
			header('Content-type: application/json; charset=utf-8');
			$htmlOutput = json_encode($html, JSON_FORCE_OBJECT);
		} else {
			$htmlOutput = implode($html);
			if (HTML5CHECK) {
				CORE::$ObjClass['MVC']['HTML5VAL']->valHTML5($htmlOutput);
			}
		}
		$lasterror = error_get_last();
		$anyHeader = headers_sent();
		if ($lasterror == null && !$anyHeader) {
			echo $htmlOutput;
		} else {
			CORE::$ObjClass['GEN']['VARS']->VarExport_C($lasterror);
		}
	}
	public function ShowEventOutput() {
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

			$show     = (CORE::$ObjVar['EVENT']['SHOW'] !== true) ? false : CORE::$ObjVar['EVENT']['SHOW'];
			$in       = (CORE::$ObjVar['EVENT']['IN'] === null) ? '' : CORE::$ObjVar['EVENT']['IN'];
			$data     = (CORE::$ObjVar['DISPLAY']['HTML']['DATA'] == null) ? '' : CORE::$ObjVar['DISPLAY']['HTML']['DATA'];
			$ref      = (CORE::$ObjVar['EVENT']['REFRESH'] !== true) ? false : CORE::$ObjVar['EVENT']['REFRESH'];
			$nav      = (CORE::$ObjVar['EVENT']['NAV'] !== true) ? false : CORE::$ObjVar['EVENT']['NAV'];
			$data     = CORE::$ObjClass['GEN']['VARS']->ScapeQuote2Json($data);
			$toClient = ['show' => $show, 'in' => $in, 'data' => $data, 'ref' => $ref, 'nav' => $nav];
			$count    = 1;
			$iModal   = 100;
			$addMore  = [];
			//CORE::$ObjClass['GEN']['VARS']->VarExport_C('Llegue');
			while ($count <= 5) {
				if (isset(CORE::$ObjVar['EVENT']['G' . $count])) {
					$data                  = CORE::$ObjVar['EVENT']['G' . $count]['DATA'];
					$addMore['G' . $count] = ['in' => $iModal, 'data' => $data];
					$toClient              = array_merge($toClient, $addMore);
				}
				$count++;
				$iModal++;
			}
			$isFormated = CORE::$ObjClass['GEN']['VARS']->CheckIfArr2JSON($toClient);
			$lasterror  = error_get_last();
			$anyHeader  = headers_sent();
			if ($isFormated == true && $lasterror == null && !$anyHeader) {
				$outresult = json_encode($toClient);
				header('Content-type: application/json');
				echo $outresult;
			} else {
				CORE::$ObjClass['GEN']['VARS']->VarExport_C($lasterror);
			}
		} catch (Exception $e) {
			CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
			CORE::$ObjClass['GEN']['ERROR']->GetError();
		}
	}
	public function ShowFormOutput() {
		try {
			//CORE::$ObjClass['GEN']['VARS']->VarExport_C('FIN TEST');
			$toClient = [
				'title' => CORE::$ObjVar['DISPLAY']['HTML']['TITLE'],
				'cont'  => CORE::$ObjVar['DISPLAY']['HTML']['FORMCONT'],
			];
			$lasterror  = error_get_last();
			$isFormated = CORE::$ObjClass['GEN']['VARS']->CheckIfArr2JSON($toClient);
			$lasterror  = error_get_last();
			$anyHeader  = headers_sent();
			if ($isFormated == true && $lasterror == null && !$anyHeader) {
				$outresult = json_encode($toClient);
				header('Content-type: application/json');
				echo $outresult;
			} else {
				CORE::$ObjClass['GEN']['VARS']->VarExport_C($lasterror);
			}
			exit;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	public function ShowWebServiceData() {
		header('Content-type:application/json');
		echo CORE::$ObjVar['WEB']['SERVICE']['DATA'];
	}
	*/

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
                CoreApp::$oclass['GEN']['VARS']->VarExport_C($lasterror);
            }
        }
    }
}
