<?php

namespace IcarosNet\LastHammer\Mvc;
use IcarosNet\LastHammer\Gen\Vars;

class Controller
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function runController()
    {
        # ! ::::::::WARNING:::::::: Do not touch this section ::::::::WARNING::::::::
        $output     = 1;
        $process    = null;
        $template   = null;
        $stuser     = \CoreApp::$ovars['USER']['LOGGED'];
        $isdata     = \CoreApp::$ovars['SYS']['HTTP']['STATE'];
        $isdatatype = \CoreApp::$ovars['SYS']['HTTP']['METHOD'];
        $iscron     = \CoreApp::$ovars['SYS']['SERVICE']['CRON'];
        $iswser     = \CoreApp::$ovars['SYS']['SERVICE']['WEBSER'];
        Lang::_getInstance()->routeLang();
        ($stuser ? ($isdata ? ('GET' == $isdatatype ? $template = 3 : $process = 1) : $template = 1) :
            ($isdata && 'POST' == $isdatatype ? ($iscron ? list($process, $output) = [1, null] :
                ($iswser ? list($process, $output) = [1, 2] : $process = 1)) :
                ($isdata && 'GET' == $isdatatype ? $template = 1 : $template = 2)
            )
        );

        # ? Template can set to: 1= Default in Xml Config (Dashboard || Home Web Page), 2=Login, 3=Forms
        # - all Proccess Run on the same enviroment.
        # - output can set to: 1 HTML format, 2 JSON

        (null === $process) ?: Process::_getInstance()->runProcess();                                                                                                                                                     //Model
        (null === $template) ?: Template::_getInstance()->getView($template);                                                                                                                                             //View
        (null === $output) ? Vars::_getInstance()
            ->expVariable(true, true, false, true, \CoreApp::$ovars, [$stuser, $isdata, $isdatatype, $iscron, $iswser]) : OutputData::_getInstance()
            ->showOutput($output); //Output

        # ! ::::::::WARNING:::::::: Do not touch this section ::::::::WARNING::::::::
    }
}
