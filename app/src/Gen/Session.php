<?php

namespace IcarosNet\LastHammer\Gen;

use IcarosNet\LastHammer\CoreApp;

class Session
{
    private static $instance = null;

    public static function getInstance(): Session
    {
        if (!self::$instance instanceof self) self::$instance = new self;
        return self::$instance;
    }

    public function destUserSession($why)
    {
        session_destroy();
        Cookie::getInstance()->destCookies();
        ExecTime::getInstance()->execRefresh(['time' => 0, 'why' => $why]);
        exit;
    }

    public function getSessionLang()
    {
        CoreApp::$ovars['DISPLAY']['DIC']['USERSES'] = ($_SESSION['LANG']) ? $_SESSION['LANG'] : CoreApp::$ovars['DISPLAY']['DIC']['DEFULT'];
    }

    public function initSession()
    {
        if (!isset($_SESSION)) {
            session_name(SESSION_NAME);
            session_start();
        }
        if (!isset($_SESSION['START'])) {
            $_SESSION['START']    = true;
            $_SESSION['TIMEOUT']  = SESSION_TIME_OUT;
            $_SESSION['ACTIVITY'] = SESSION_TIME_EXPIRE;
            $_SESSION['LANG']     = DEFAULTLANG;
            $_SESSION['HOME']     = HOME;
            Cookie::getInstance()->initCookies();
        } else {
            if (SESSION_EXPIRATION == true) {
                if ($_SESSION['TIMEOUT'] < time()) {
                    $this->destUserSession('Session Time is Over.');
                }
            }
            if (SESSION_INACTIVITY == true) {
                if ($_SESSION['ACTIVITY'] < time()) {
                    $this->destUserSession('Session has ended due to Inactivity.');
                }
            }
            $_SESSION['ACTIVITY'] = SESSION_TIME_EXPIRE;
        }
    }
}
