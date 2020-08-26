<?php

namespace IcarosNet\LastHammer\Gen;
use IcarosNet\LastHammer\CoreApp;

class Http
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function initClientCommunication()
    {
        $http = &CoreApp::$ovars['SYS']['HTTP'];
        if (isset($_SERVER['HTTPS']) && 'on' == $_SERVER['HTTPS']) {
            $protocol = $http['PROTOCOL'] = 'HTTPS';
            $checksec = $http['SSL'] = true;
        } else {
            $protocol = $http['PROTOCOL'] = 'HTTP';
            $checksec = $http['SSL'] = false;
        }
        if (PROTOCOL !== $protocol && false == $checksec) {
            header("Location: http://".DOMAIN.$_SERVER["REQUEST_URI"]);
            exit;
        } elseif (PROTOCOL !== $protocol && true == $checksec) {
            header("Location: https://".DOMAIN.$_SERVER["REQUEST_URI"]);
            exit;
        }
        if (REQUEST_METHOD !== null) {
            $http['METHOD'] = REQUEST_METHOD;
            $http['STATE']  = true;
            $this->buildFormRequest();
        }
    }

    private function buildFormRequest()
    {
        if (REQUEST_TYPE == 'application/json') {
            CoreApp::$ovars['SYS']['HTTP']['JSON'] = true;
        } elseif (REQUEST_TYPE !== 'application/json') {
            CoreApp::$ovars['SYS']['HTTP']['JSON'] = 'mix';
        }
        $_vars                              = (REQUEST_METHOD == 'POST') ? $_POST : $_GET;
        $_vars                              = $this->buildVirtualData($_vars);
        $_vars                              = Vars::_getInstance()->reduArray($_vars);
        (REQUEST_METHOD == 'POST') ? $_POST = [] : $_GET = [];
        (REQUEST_METHOD == 'POST') ? $_POST = $_vars : $_GET = $_vars;
        if (REQUEST_METHOD == 'POST') {
            if (isset($_POST['form'])) {
                $service = explode('-', $_POST['form']);
                $iscron  = &CoreApp::$ovars['SYS']['SERVICE']['CRON'];
                $iswser  = &CoreApp::$ovars['SYS']['SERVICE']['WEBSER'];
                $iscron  = ('c' === $service[0]) ? true : false;
                $iswser  = ('ws' === $service[0]) ? true : false;
            }
        }
    }

    private function buildVirtualData($data)
    {
        $var_mgr = Vars::_getInstance();
        if (is_array($data)) {
            $temp = [];
            foreach ($data as $key => $value) {
                $temp[$key] = $this->buildVirtualData($value);
            }
            return $var_mgr->reduArray($temp);
        } elseif ($var_mgr->valJson($data)) {
            $json_obj = json_decode($data, true);
            foreach ($json_obj as $key1 => $json_sub_obj) {
                foreach ($json_sub_obj as $key2 => $value2) {
                    if (is_array($value2)) {
                        $temp = [];
                        foreach ($value2 as $keyof => $valueof) {
                            $temp[$keyof] = $this->buildVirtualData($valueof);
                        }
                        $json_obj[$key1][$key2] = $temp;
                    } else {
                        if ('true' === $value2 || true === $value2) {
                            $json_obj[$key1][$key2] = true;
                        } elseif ('false' === $value2 || false === $value2) {
                            $json_obj[$key1][$key2] = false;
                        } else {
                            $json_obj[$key1][$key2] = $value2;
                        }
                    }
                }
                return $var_mgr->reduArray($json_obj);
            }
        } else {
            if ('true' === $data || true === $data) {
                $data = true;
            } elseif ('false' === $data || false === $data) {
                $data = false;
            }
            return $data;
        }
    }
}
