<?php
class ClassProcessManager
{
    static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /*

    public function RunProcess()
    {
        try {
            CORE::$ObjVar['SIS'] = array_merge(
                CORE::$ObjVar['SIS'],
                [
                    'PROCESS'      => $_POST['idprocess'],
                    'IDFORM'       => $_POST['idform'],
                    'FORMNAME'     => (!isset($_POST['form_name'])) ? UNKNOWN : $_POST['form_name'],
                    'StrucForm'    => explode('-', $_POST['idform']),
                    'StrucProcess' => explode('-', $_POST['idprocess'])
                ]
            );
            $ObjClass['DIR']  = [];
            $ObjClass['FORM'] = [];
            $this->ClassCore();
            if (null != CORE::$ObjClass['FORM']) {
                if ('f' == CORE::$ObjVar['SIS']['StrucForm'][0]) {
                    CORE::$ObjClass['FORM']['PRO']->Events();
                } elseif ('c' == CORE::$ObjVar['SIS']['StrucForm'][0]) {
                    CORE::$ObjClass['FORM']['CRON']->Task();
                } elseif ('ws' == CORE::$ObjVar['SIS']['StrucForm'][0]) {
                    CORE::$ObjClass['FORM']['SERV']->Service();
                }
            } else {
                CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 0;
                throw new Exception("El sistema no pudo procesar los datos enviados, al parecer el proceso: ".$_POST['idform']." y el evento: ".$_POST['idprocess']." no se encuentra.");
            }
        } catch (Exception $e) {
            CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
            CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
        }
    }

    private function ClassCore()
    {
        if ('f' == CORE::$ObjVar['SIS']['StrucForm'][0]) {
            $Dir = CLASSCORE.CORE::$ObjVar['SIS']['StrucForm'][1].'/'.CORE::$ObjVar['SIS']['StrucForm'][0].'-'.CORE::$ObjVar['SIS']['StrucForm'][1].'-'.CORE::$ObjVar['SIS']['StrucForm'][2].'/scripts/';
        } elseif ('c' == CORE::$ObjVar['SIS']['StrucForm'][0]) {
            $Dir = CLASSCORE.CORE::$ObjVar['SIS']['StrucForm'][1].'/'.CORE::$ObjVar['SIS']['StrucForm'][0].'-'.CORE::$ObjVar['SIS']['StrucForm'][1].'-'.CORE::$ObjVar['SIS']['StrucForm'][2].'/';
        } elseif ('ws' == CORE::$ObjVar['SIS']['StrucForm'][0]) {
            $Dir = CLASSCORE.CORE::$ObjVar['SIS']['StrucForm'][1].'/'.CORE::$ObjVar['SIS']['StrucForm'][0].'-'.CORE::$ObjVar['SIS']['StrucForm'][1].'-'.CORE::$ObjVar['SIS']['StrucForm'][2].'/';
        }
        CORE::$ObjClass['FORM'] = null;
        if (is_dir($Dir)) {
            $CoreD = array_diff(scandir($Dir, 1), ['..', '.']);
            foreach ($CoreD as $key => $name) {
                if (strpos($name, '.php') !== false) {
                    $this->RequireClassFile($Dir.$name);
                    $name                                   = preg_replace('#\.php#', '', $name);
                    $InstanceClass                          = strtoupper($name);
                    $name                                   = ucfirst(strtolower($name));
                    $NamesClass                             = 'Class_'.$name;
                    CORE::$ObjClass['FORM'][$InstanceClass] = $this->$InstanceClass = new $NamesClass();
                }
            }
        }
    }
    private function RequireClassFile($fileDir)
    {
        return require_once $fileDir;
    }
    */
    public function runProcess()
    {
        try {

            CoreApp::$ovars['SYS'] = array_merge(
                CoreApp::$ovars['SYS'],
                [
                    'PROCESS'       => $_POST['process'],
                    'FORM'          => $_POST['form'],
                    'STRUC_PROCESS' => explode('-', $_POST['process']),
                    'STRUC_FORM'    => explode('-', $_POST['form'])
                ]
            );
            CoreApp::$oclass['DIR']  = [];
            CoreApp::$oclass['FORM'] = [];

            CoreApp::$oclass['GEN']['VARS']->expVariable(true, true, false, true, $_POST);
            //echo var_dump($_POST);
            //CoreApp::$ovars['SYS']['ERROR']['TYPE'] = 'k';
            //throw new Exception("Example Error throw.");
            //die;
            //CoreApp::$ovars['SYS']['ERROR']['TYPE'] = 3;
            //throw new Exception("Example Error throw.");
            //echo 'Hello World';
            /*
            CORE::$ObjVar['SIS'] = array_merge(
                CORE::$ObjVar['SIS'],
                [
                    'PROCESS'      => $_POST['idprocess'],
                    'IDFORM'       => $_POST['idform'],
                    'FORMNAME'     => (!isset($_POST['form_name'])) ? UNKNOWN : $_POST['form_name'],
                    'StrucForm'    => explode('-', $_POST['idform']),
                    'StrucProcess' => explode('-', $_POST['idprocess'])
                ]
            );
            $ObjClass['DIR']  = [];
            $ObjClass['FORM'] = [];
            $this->ClassCore();
            if (null != CORE::$ObjClass['FORM']) {
                if ('f' == CORE::$ObjVar['SIS']['StrucForm'][0]) {
                    CORE::$ObjClass['FORM']['PRO']->Events();
                } elseif ('c' == CORE::$ObjVar['SIS']['StrucForm'][0]) {
                    CORE::$ObjClass['FORM']['CRON']->Task();
                } elseif ('ws' == CORE::$ObjVar['SIS']['StrucForm'][0]) {
                    CORE::$ObjClass['FORM']['SERV']->Service();
                }
            } else {
                CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 0;
                throw new Exception("El sistema no pudo procesar los datos enviados, al parecer el proceso: ".$_POST['idform']." y el evento: ".$_POST['idprocess']." no se encuentra.");
            }
            */
        } catch (Exception $e) {
            CoreApp::$ovars['SYS']['ERROR']['ARRAY'] = $e;
            CoreApp::$oclass['MVC']['ERROR']->getError();
        }
    }
}
