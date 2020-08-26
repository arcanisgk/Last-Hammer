<?php

namespace IcarosNet\LastHammer\Mvc;
use CoreApp;
use IcarosNet\LastHammer\Gen\File;
use IcarosNet\LastHammer\Gen\Session;

class Lang
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getTranslation($data)
    {
        #Usado
        $dic = CoreApp::$ovars['TRANSLATION'];
        foreach ($dic as $key => $value) {
            $data = str_replace('{'.$key.'}', $value, $data);
        }
        return $data;
    }

    public function loadLang($dir = null)
    {
        $langIndex = substr(CoreApp::$ovars['DISPLAY']['DIC']['LANG'], 0, 2);
        $dicpath   = (null !== $dir) ? $dir : PATHS['DIC'].'dic.csv';
        $fileread  = File::_getInstance()->fileRead($dicpath);
        $fileindex = fgetcsv($fileread, 4096, ';', '"');
        foreach ($fileindex as $key => $value) {
            if ($langIndex == $value) {
                $langIndex = $key;
                break;
            }
        }
        $lines     = 0;
        $langarray = [];
        $data      = file_get_contents($dicpath);
        $rows      = explode("\n", $data);
        $data      = [];
        foreach ($rows as $row) {
            if ('' !== $row) {
                $arrline                = explode(';', $row);
                $langarray[$arrline[0]] = $arrline[$langIndex];
                ++$lines;
            }
        }
        CoreApp::$ovars['TRANSLATION'] = array_merge(CoreApp::$ovars['TRANSLATION'], $langarray);
    }

    public function routeLang()
    {
        $dic = &CoreApp::$ovars['DISPLAY']['DIC'];
        $this->detectDefaultLang();
        Session::_getInstance()->getSessionLang();
        if (null !== $dic['USERSES']) {
            $dic['LANG'] = $dic['USERSES'];
        } else {
            if ($dic['DEVICELANG'] !== $dic['DIC']['DEFULT']) {
                if (file_exists(PATHS['DIC'].$dic['DEVICELANG'].'.php')) {
                    $dic['LANG'] = $dic['DIC']['DEVICE'];
                } else {
                    $dic['LANG'] = $dic['DIC']['DEFULT'];
                }
            } else {
                $dic['LANG'] = $dic['DEVICE'];
            }
        }
        $this->loadLang();
    }

    private function detectDefaultLang()
    {
        $deflang = &CoreApp::$ovars['DISPLAY']['DIC']['DEVICELANG'];
        $deflang = (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? str_replace("-", "_", substr(DEFAULTLANG, 0, 5)) : str_replace("-", "_", substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5));

    }
}
