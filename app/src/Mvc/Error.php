<?php

namespace IcarosNet\LastHammer\Mvc;

use IcarosNet\LastHammer\CoreApp;
use IcarosNet\LastHammer\Gen\{Date, File, Log};

class Error
{
    public $display;

    public $file_mgr;

    private static $instance = null;

    public static function getInstance(): Error
    {
        if (!self::$instance instanceof self) self::$instance = new self;
        return self::$instance;
    }

    private $tplerror = [
        'error'    => PATHS['TPLSTATUS'].'/errors/error.php',
        'error-c'  => PATHS['TPLSTATUS'].'/errors/error-c.php',
        'error-ws' => PATHS['TPLSTATUS'].'/errors/error-ws.php'
    ];

    public function getError()
    {
        // Vairable Usage
        Lang::getInstance()->loadLang(PATHS['DIC'].'error/dic.csv');
        (isset($_SESSION['Username']) ? list($username, $id_user) = [$_SESSION['username'], $_SESSION['id_user']] : list($username, $id_user) = ['Unknown', 'Unknown']);
        $sis_obj                       = &CoreApp::$ovars;
        $this->file_mgr                = File::getInstance();
        $this->display                 = &CoreApp::$ovars['DISPLAY']['HTML'];
        $error_smg                     = '';
        $error_log                     = '';
        $c_date                        = Date::getInstance()->genDate('H', 'es');
        $c_hour                        = Date::getInstance()->genDate('C');
        $form                          = (null != $sis_obj['SYS']['FORM']) ? $sis_obj['SYS']['FORM'] : 'Form Unknown';
        $event                         = (null != $sis_obj['SYS']['PROCESS']) ? $sis_obj['SYS']['PROCESS'] : 'Not Detected';
        $error_type                    = (null != $sis_obj['SYS']['ERROR']['TYPE']) ? $sis_obj['SYS']['ERROR']['TYPE'] : null;
        $e                             = $sis_obj['SYS']['ERROR']['ARRAY'];
        $file                          = $e->getFile();
        $file_log                      = basename($file);
        $line                          = $e->getLine();
        $description                   = $e->getMessage();
        $trace_error                   = $e->getTraceAsString();
        $output                        = true;
        $user_comment                  = '<div class="form-group row"><div class="col-lg-12"><div class="summernote sumertextarea" name="i-t-comment"></div></div></div>';
        $this->display['ERROR']['SMG'] = 'Unknown!';
        $this->display['ERROR']['LOG'] = '<tr><td>'.$c_date.'</td><td>'.$c_hour.'</td><td>'.$username.'</td><td>'.$id_user.'</td><td>'.$form.'</td><td>'.$event.'</td><td>'.$file_log.'</td><td>'.$line.'</td><td>'.$description.'</td></tr>';
        //Error Analysis:
        if (in_array($error_type, [1, 2, 3, 4, 'email', 'db'])) {
            # ! (1): Cross System Error
            # ! (2): System error
            # ! (3): User Error
            # ! (4): Alert Control Error
            # ! (email): Email Send Execution
            # ! (db): Database Query Execution
            $this->display['ERROR']['SMG'] = $this->file_mgr->getFileContent($this->tplerror['error'], ['form' => $form, 'event' => $event, 'description' => $description, 'user_comment' => $user_comment, 'line' => $line, 'file' => $file]);
        } else {
            switch ($error_type) {
                case 'c': # ! CRON Execution
                    $this->display['ERROR']['SMG'] = $this->file_mgr->getFileContent($this->tplerror['error-c'], ['form' => $form, 'event' => $event, 'description' => $description, 'user_comment' => $user_comment, 'line' => $line, 'file' => $file]);
                    break;
                case 'k': # ! Keeper Execution
                    $this->display['ERROR']['SMG'] = $this->file_mgr->getFileContent($this->tplerror['error-c'], ['form' => $form, 'event' => $event, 'description' => $description, 'user_comment' => $user_comment, 'line' => $line, 'file' => $file]);
                    break;
                case 'ws': # ! Web Service Execution
                    $this->display['ERROR']['SMG'] = $this->file_mgr->getFileContent($this->tplerror['error-ws'], ['form' => $form, 'event' => $event, 'description' => $description, 'user_comment' => $user_comment, 'line' => $line, 'file' => $file]);
                    break;
                default: # ! Default Unknown Error
                    $this->display['ERROR']['SMG'] = $this->file_mgr->getFileContent($this->tplerror['error'], ['form' => $form, 'event' => $event, 'description' => $description, 'user_comment' => $user_comment, 'line' => $line, 'file' => $file]);
                    break;
            }
        }
        //Error Log:
        Log::getInstance()->setLogReg($this->display['ERROR']['LOG'], 'error');
        //Error Output:

        if ('email' == $error_type) {
            //if email fail try to send error email report.
            $this->sendEMailError($this->display['ERROR']['SMG']);
        } else {
            if ('c' == $error_type) {
                $this->sendCronJobError($this->display['ERROR']['SMG']);
            } elseif ('k' == $error_type) {
                $this->sendKeeperJobError($this->display['ERROR']['SMG']);
            } elseif ('ws' == $error_type) {
                CoreApp::$ovars['DISPLAY']['HTML']['OUTJSON'] = true;
            }
            $error_output_like                         = (in_array($error_type, [1, 2, 3, 4]) ? $error_type : 2);
            CoreApp::$ovars['EVENT']['SHOW']           = true;
            CoreApp::$ovars['EVENT']['IN']             = $error_output_like;
            CoreApp::$ovars['EVENT']['REFRESH']        = (null == CoreApp::$ovars['EVENT']['REFRESH'] ? false : true);
            CoreApp::$ovars['EVENT']['NAV']            = (null == CoreApp::$ovars['EVENT']['NAV'] ? false : true);
            CoreApp::$ovars['DISPLAY']['HTML']['DATA'] = $this->display['ERROR']['SMG'];
            OutputData::getInstance()->showEvent(1);
        }
    }

    private function sendCronJobError($smg)
    {
        $DataMail = [];
        /*
        $DataMail          = CORE::$ObjClass['GEN']['MAILMANAGER']->InitMail();
        $DataMail['SEND']  = true;
        $DataMail['2Mail'] = MSUPPORT;
        $DataMail['prio']  = true;
        $DataMail['subj']  = 'Error de Sistema Cron.';
        $DataMail['cont']  = $ErrorSMG;
        $DataMail['type']  = 3;
        $DataMail['track'] = CORE::$ObjClass['GEN']['MAILMANAGER']->SendMail($DataMail);
        */
        die;
    }

    private function sendEMailError($smg)
    {
        $DataMail = [];
        /*
        $DataMail          = CORE::$ObjClass['GEN']['MAILMANAGER']->InitMail();
        $DataMail['SEND']  = true;
        $DataMail['2Mail'] = MSUPPORT;
        $DataMail['prio']  = true;
        $DataMail['subj']  = 'Error de Sistema Cron.';
        $DataMail['cont']  = $ErrorSMG;
        $DataMail['type']  = 3;
        $DataMail['track'] = CORE::$ObjClass['GEN']['MAILMANAGER']->SendMail($DataMail);
        */
    }

    private function sendKeeperJobError($smg)
    {
        $DataMail = [];
        /*
        $DataMail          = CORE::$ObjClass['GEN']['MAILMANAGER']->InitMail();
        $DataMail['SEND']  = true;
        $DataMail['2Mail'] = MSUPPORT;
        $DataMail['prio']  = true;
        $DataMail['subj']  = 'Error de Sistema Keeper.';
        $DataMail['cont']  = $ErrorSMG;
        $DataMail['type']  = 3;
        $DataMail['track'] = CORE::$ObjClass['GEN']['MAILMANAGER']->SendMail($DataMail);
        */
        die;
    }
}
