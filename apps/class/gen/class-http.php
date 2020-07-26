<?php
class ClassHttpManager
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
        $_vars                              = CoreApp::$oclass['GEN']['VARSMANAGER']->reduArray($_vars);
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
        $var_mgr = &CoreApp::$oclass['GEN']['VARSMANAGER'];
        if (is_array($data)) {
            $result = [];
            foreach ($data as $key1 => $val1) {
                $valjson = $var_mgr->valJson($val1);
                if ($valjson) {
                    $jsonObj       = json_decode($val1, true);
                    $result[$key1] = $this->buildVirtualData($jsonObj);
                } elseif (false == $valjson && is_array($val1)) {
                    foreach ($val1 as $key2 => $val2) {
                        $result[$key1][$key2] = $this->buildVirtualData($val2);
                    }
                } else {
                    if ('true' === $val1) {
                        $val1 = true;
                    } elseif ('false' === $val1) {
                        $val1 = false;
                    }
                    $result[$key1] = $val1;
                }
            }
            return $result;
        } else {
            if ($var_mgr->valJson($data)) {
                $jsonObj = json_decode($data, true);
                return $this->buildVirtualData($jsonObj);
            } else {
                return $data;
            }
        }
    }
}
