<?php

namespace IcarosNet\LastHammer\Gen;

use IcarosNet\LastHammer\CoreApp;
use Exception;

class Date
{
    private static $instance = null;

    public static function getInstance(): Date
    {
        if (!self::$instance instanceof self) self::$instance = new self;
        return self::$instance;
    }

    public function ValidateDate($date)
    {
        return strtotime($date) != false;
    }

    public function calcRunTime($inputSeconds = 0)
    {
        $secondsInAMinute = 60;
        $secondsInAnHour  = 60 * $secondsInAMinute;
        $secondsInADay    = 24 * $secondsInAnHour;
        $days             = floor($inputSeconds / $secondsInADay);
        $hourSeconds      = $inputSeconds % $secondsInADay;
        $hours            = floor($hourSeconds / $secondsInAnHour);
        $minuteSeconds    = $hourSeconds % $secondsInAnHour;
        $minutes          = floor($minuteSeconds / $secondsInAMinute);
        $remainingSeconds = $minuteSeconds % $secondsInAMinute;
        $seconds          = ceil($remainingSeconds);
        $sections         = [
            'Day'    => (int) $days,
            'Hour'   => (int) $hours,
            'Minute' => (int) $minutes,
            'Second' => (int) $seconds
        ];
        $timeParts = [];
        foreach ($sections as $name => $value) {
            if ($value > 0) {
                $timeParts[] = $value.' '.$name.(1 == $value ? '' : 's');
            }
        }
        $result = implode(', ', $timeParts);
        if ('' == $result) {
            $result = 'Less than 1 second';
        }
        return $result;
    }

    public function genDate($format = '', $lang = false)
    {
        try {
            $gendate = '';
            switch ($format) {
                case 'A':
                    $gendate = date("Y-m-d H:i:s");
                    break;
                case 'B':
                    $gendate = date("Y-m-d");
                    break;
                case 'C':
                    $gendate = date("H:i:s");
                    break;
                case 'D':
                    $gendate = date("YmdHis");
                    break;
                case 'E':
                    $gendate = date("Y_m_d");
                    break;
                case 'F':
                    $gendate = date("Y_m_d_H_i_s");
                    break;
                case 'G':
                    $gendate = date("Y-M-d H:i:s");
                    break;
                case 'H':
                    $gendate = date("Y-M-d");
                    break;
                default:
                    $gendate = date("Y-m-d H:i:s");
                    break;
            }
            if (false !== $lang) {
                if ('en' == $lang) {
                    CoreApp::$ovars['SYS']['ERROR']['TYPE'] = 0;
                    throw new Exception("The default date generation is in English, you cannot convert it to English.");
                } else {
                    if ('G' == $format || 'H' == $format) {
                        return $this->translateDate($gendate, $lang);
                    } else {
                        CoreApp::$ovars['SYS']['ERROR']['TYPE'] = 0;
                        throw new Exception("Hello, a date manipulation error was detected, attempt to translate to (".$lang.") with the format: (".$format.") it's not possible!");
                    }
                }
            } else {
                return $gendate;
            }
        } catch (Exception $e) {
            CoreApp::$ovars['SYS']['ERROR']['TYPE'] = 0;
            echo $e->getMessage();
            //exit;
            /*
        CoreApp::$ObjSiS['SYS']['ERROR']['ARR'] = $e;
        CoreApp::$ObjClassInst['Generic']['ERRORMANAGER']->GetError();
         */
        }
    }

    public function translateDate($date, $lang)
    {
        if ('es' == $lang) {
            $months = ['Jan' => 'Ene', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Abr', 'May' => 'May', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Ago', 'Sep' => 'Sep', 'Oct' => 'Oct', 'Nov' => 'Nov', 'Dec' => 'Dic'];
        }
        if ('en' == $lang) {
            $months = ['Ene' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Abr' => 'Apr', 'May' => 'May', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Ago' => 'Aug', 'Sep' => 'Sep', 'Oct' => 'Oct', 'Nov' => 'Nov', 'Dic' => 'Dec'];
        }
        return str_replace(array_keys($months), $months, $date);
    }
}
