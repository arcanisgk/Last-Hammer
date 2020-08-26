<?php

namespace IcarosNet\LastHammer\Mvc;

use IcarosNet\LastHammer\CoreApp;
use IcarosNet\LastHammer\Gen\{App, File, Vars};

class Template
{
    public $display;

    public $file_mgr;

    public $mvc;

    private $dicfiles = [
        'login_dic' => PATHS['CLASSCORE'].'sys/d-login/dic/dic.csv'
    ];

    private static $instance = null;

    public static function getInstance(): Template
    {
        if (!self::$instance instanceof self) self::$instance = new self;
        return self::$instance;
    }

    private $tplfiles = [
        'header'     => PATHS['TPLSTATIC'].'header.php',
        'b_start'    => PATHS['TPLSTATIC'].'b-start.php',
        'login'      => PATHS['CLASSCORE'].'sys/d-login/tpl/login.php',
        'm_area'     => PATHS['TPLSTATIC'].'m-area.php',
        'js_area'    => PATHS['TPLSTATIC'].'js-area.php',
        'b_close'    => PATHS['TPLSTATIC'].'b-close.php',
        'm.dt.start' => '/sources/tpl/nav/m.dt.start.php',
        'm.dt.su'    => '/sources/tpl/nav/m.dt.su.php',
        'm.dt.end'   => '/sources/tpl/nav/m.dt.end.php',
        'm.ds.start' => '/sources/tpl/nav/m.ds.start.php',
        'm.ds.su'    => '/sources/tpl/nav/m.ds.su.php',
        'm.ds.end'   => '/sources/tpl/nav/m.ds.end.php',
        'm.mt.start' => '/sources/tpl/nav/m.mt.start.php',
        'm.mt.su'    => '/sources/tpl/nav/m.mt.su.php',
        'm.mt.end'   => '/sources/tpl/nav/m.mt.end.php',
        'm.ms.start' => '/sources/tpl/nav/m.ms.start.php',
        'm.ms.su'    => '/sources/tpl/nav/m.ms.su.php',
        'm.ms.end'   => '/sources/tpl/nav/m.ms.end.php',
        'd.web'      => '/sources/tpl/home/d.web.php',
        'd.dash'     => '/sources/tpl/home/d.dash.php',
        'm.web'      => '/sources/tpl/home/m.web.php',
        'm.dash'     => '/sources/tpl/home/m.dash.php',
        'footer'     => '/sources/tpl/struct/footer.php'
    ];

    public function getView($template)
    {
        $valsoftware    = App::getInstance()->checkInstall();
        $this->display  = &CoreApp::$ovars['DISPLAY']['HTML'];
        $this->file_mgr = File::getInstance();
//        Vars::getInstance()->expVariable(true, true, false, false, $valsoftware);
        if (false !== $valsoftware) {
            (1 === $valsoftware ? $this->getLicenseForm() : '');
            (2 === $valsoftware ? $this->getUpdateForm() : '');
            (3 === $valsoftware ? $this->getInstallForm() : '');
        } else {
            # ! 1=dashboard,2=Web,3=Store
            if (1 == $template) {
                switch (CLIENT_DATA['SOFTWARE']['HOME']) {
                    case 1: //
                        $this->getDashboard();
                        break;
                    case 2: //
                        $this->getWebSite();
                        break;
                    case 3:
                        $this->getWebStore();
                        break;
                }
            } elseif (2 == $template) {

                $this->getLogin();
            } elseif (3 == $template) {

                $this->getForms();
            }
        }
    }

    private function buildHtml()
    {
        $html = &CoreApp::$ovars['DISPLAY']['HTML'];
        foreach ($html as $key => $htmlpart) {
            if (!in_array($key, ['OUTJSON', 'DATA', 'CRUD'])) {
                CoreApp::$ovars['DISPLAY']['TOBROWSER'][] .= $htmlpart;
            }
        }
    }

    private function getDashboard()
    {
        echo 'Get Dashboard<br>'; //Get Dashboard
    }

    private function getForms()
    {
        echo 'Get Forms<br>'; //Get Forms
    }

    private function getHtmlBodyClose()
    {
        $this->display['BODYCLOSE'] = $this->file_mgr->getFileContent($this->tplfiles['b_close']);
    }

    private function getHtmlBodyStart()
    {
        $this->display['BODYSTART'] = $this->file_mgr->getFileContent($this->tplfiles['b_start']);
    }

    private function getHtmlHeader()
    {
        $this->display['HEADER'] = $this->file_mgr->getFileContent($this->tplfiles['header']);
    }

    private function getHtmlJsAssets()
    {
        $this->display['JSCRIPT'] = $this->file_mgr->getFileContent($this->tplfiles['js_area']);
    }

    private function getHtmlLoginContent()
    {
        Lang::getInstance()->loadLang($this->dicfiles['login_dic']);
        $this->display['LOGIN'] = $this->file_mgr->getFileContent($this->tplfiles['login']);
    }

    private function getHtmlModals()
    {
        $this->display['MODALS'] = $this->file_mgr->getFileContent($this->tplfiles['m_area']);
    }

    private function getInstallForm()
    {
        //hack Pendiente desarrollar
        echo 'getInstallForm';
    }

    private function getLicenseForm()
    {
        //hack Pendiente desarrollar
        echo 'getLicenseForm';
    }

    private function getLogin()
    {
        $this->getHtmlHeader();
        $this->getHtmlBodyStart();
        $this->getHtmlLoginContent();
        $this->getHtmlModals();
        $this->getHtmlJsAssets();
        $this->getHtmlBodyClose();
        $this->buildHtml();
    }

    private function getUpdateForm()
    {
        //hack Pendiente desarrollar
        echo 'getUpdateForm';
    }

    private function getWebSite()
    {
        echo 'Get Web Site<br>'; //Get Web Site
    }

    private function getWebStore()
    {
        echo 'Get Web Store<br>'; //Get Web Store
    }
}
