<?php
class ClassVarsManager
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function destVars()
    {
        $vars = [];
        $vars = array_keys(get_defined_vars());
        foreach ($vars as $var) {
            unset(${"$var"});
        }
        unset($vars);
        CoreApp::$oclass = null;
        CoreApp::$ovars  = null;
        foreach (get_class_vars(__CLASS__) as $clsVar) {
            unset($clsVar);
        }
        die;
    }

    public function evalArray2JSON($Var)
    {
        return (json_encode($Var)) ? true : false;
    }

    public function expVariable($ouput, $highlight = true, $return = false, $end = false, ...$var)
    {
        try {
            if (true == $return && true == $end) {
                throw new Exception('You cannot request a data return and exit at execution time.');
            } elseif (true == $return && true == $ouput) {
                throw new Exception('You cannot request a data '.
                    'return and output at execution time.');
            } else {
                $result = PRES.implode(
                    EOL_SYS,
                    array_map(
                        [$this, 'varExportFormat'],
                        $var,
                        array_fill(0, count($var), $highlight)
                    )
                ).PREE;
                if ($ouput) {
                    echo $result;
                } else {
                    return $result;
                }
            }
            if ($end) {
                exit;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function initVar()
    {
        $initVar = &CoreApp::$ovars;
        $initVar = [
            'VARS'        => [],
            'TRANSLATION' => [],
            'SYS'         => [
                'EXECTIME'   => [
                    'INIT' => null
                ],
                'EXECMEMORY' => [
                    'INIT' => null
                ],
                'HTTP'       => [
                    'PROTOCOL' => null,
                    'SSL'      => null,
                    'METHOD'   => null,
                    'STATE'    => null,
                    'JSON'     => null
                ],
                'DEVICE'     => [
                    'MOBILE' => null
                ],
                'SERVICE'    => [
                    'CRON'   => null,
                    'WEBSER' => null
                ],
                'CONF'       => [],
                'FORM'       => null,
                'PROCESS'    => null,
                'ERROR'      => [
                    'TYPE'  => null,
                    'ARRAY' => []
                ]

            ],
            'USER'        => [
                'LOGGED' => null
            ],
            'EVENT'       => [
                'SHOW'    => null,
                'IN'      => null,
                'REFRESH' => null,
                'NAV'     => null
            ],
            'DISPLAY'     => [
                'HTML'      => [
                    'OUTJSON' => null
                ],
                'TOBROWSER' => [],
                'DIC'       => [
                    'DEFULT'     => DEFAULTLANG,
                    'DEVICELANG' => null,
                    'USERSES'    => null
                ]
            ]
        ];
    }

    public function reduArray($array)
    {
        $result = $array;
        if (is_array($array)) {
            $check = true;
            foreach ($array as $key => $value) {
                if (!is_array($value)) {
                    $check = false;
                    break;
                }
            }
            if ($check) {
                $result = array_reduce($array, 'array_merge', []);
            }
        }
        return $result;
    }

    public function scapeQuote2Json($string)
    {
        return htmlspecialchars($string);
    }

    public function valJson($var)
    {
        if (!is_array($var)) {
            return ((json_decode($var) != null) && (is_object(json_decode($var)) || is_array(json_decode($var)))) ? true : false;
        } else {
            return false;
        }
    }

    private function GetType($var)
    {
        if (in_array($var, ['null', 'NULL', null], true)) {
            return '(Type of NULL)';
        }
        if (in_array($var, ['TRUE', 'FALSE', 'true', 'false', true, false], true)) {
            return 'boolean';
        }
        if (is_array($var)) {
            return 'array';
        }
        if (is_object($var)) {
            return 'object';
        }
        if ((int) $var == $var && is_numeric($var)) {
            return 'integer';
        }
        if ((float) $var == $var && is_numeric($var)) {
            return 'float';
        }
        if (strpos($var, '/') !== false) {
            if (in_array($var, timezone_identifiers_list())) {
                return 'time-zone';
            }
        }
        if (strpos($var, ' ') !== false && strpos($var, ':') !== false) {
            $testdate = explode(' ', $var);
            if (
                $this->ValidateDate($testdate[0]) &&
                $this->ValidateDate($testdate[1]) &&
                strpos($testdate[1], ':') !== false
            ) {
                return 'datetime';
            }
        }
        if ($this->ValidateDate($var) && strpos($var, ':') !== false) {
            return 'time';
        }
        if ($this->ValidateDate($var) && strlen($var) >= 8) {
            return 'date';
        }
        if (is_string($var)) {
            return 'string('.strlen($var).')';
        }
    }

    private function ValidateDate($date)
    {
        return strtotime($date) != false;
    }

    private function varExportFormat($var, $highlight)
    {
        ob_start();
        var_dump($var);
        $var_dump = ob_get_clean();
        $var_dump = preg_replace(
            [
                "/\[\"|\"\]/",
                "/\]|\[/",
                "/\)\s*\{(\s*\w*)/",
                "/(\s*\w*)\}(\s*\w*)/",
                "/=>\s*(\w)/",
                "/\[\s*\](,)/",
                "~^ +~m"
            ],
            [
                "'",
                '',
                ') [$1',
                '$1],$2',
                ' => $1',
                '[]$1',
                '$0$0'
            ],
            $var_dump
        );
        $var_dump = preg_split('~\R~', $var_dump);
        $var_dump = preg_replace_callback(
            '/(\s*=>\s*)(NULL)/',
            function ($m) {
                return $m[1].$this->GetType($m[2]).": {$m[2]},";
            },
            $var_dump
        );
        $var_dump = preg_replace_callback(
            '/(\w+\W\d\W)\s*"([^"]+)"$/',
            function ($m) {
                return $this->GetType(str_replace("'", '', $m[2])).
                    ": {$m[2]},";
            },
            $var_dump
        );
        $var_dump = preg_replace_callback(
            '/\w+\((\D+)\)$/',
            function ($m) {
                return $this->GetType(str_replace("'", '', $m[1])).
                    ": {$m[1]},";
            },
            $var_dump
        );
        $var_dump = preg_replace_callback(
            '/\w+\((\d+)\)$/',
            function ($m) {
                return $this->GetType(str_replace("'", '', $m[1])).
                    ": {$m[1]},";
            },
            $var_dump
        );
        $var_dump = preg_replace_callback(
            '/\w+\((\d*\.\d*)\)$/',
            function ($m) {
                return $this->GetType(str_replace("'", '', $m[1])).
                    ": {$m[1]},";
            },
            $var_dump
        );
        $var_dump = preg_replace_callback(
            '/\w+\(\d+\)(\s*)"([^"]*)"$/',
            function ($m) {
                return $m[1].$this->GetType(str_replace("'", '', $m[2])).
                    ': "'.$m[2].'",';
            },
            $var_dump
        );
        ":";

        $var_dump = implode(PHP_EOL, $var_dump);
        $var_dump = preg_replace("/NULL\K(?=\R)/", ',', $var_dump);

        //$var_dump = preg_replace('/(\w+"):("\w+)/', '$1=>$2', $var_dump);

        $var_dump = preg_replace("/\w+\s*\[$/", '$0]', $var_dump);

        $var_dump = preg_replace('/(\R\])\,\R/', '$1', $var_dump);
        $var_dump = str_replace('":"', "'::'", $var_dump);
        $var_dump = str_replace('":"', "'::'", $var_dump);
        $var_dump = str_replace('":', "'::", $var_dump);
        $textvar  = $var_dump;
        if ($highlight && VERSYSTEM !== 'cli') {
            $textvar = highlight_string('<?php '.PHP_EOL.
                '/*****  Output of Data *****/'.PHP_EOL.$var_dump.';'.
                PHP_EOL.
                '/*****  Output of Data *****/'.PHP_EOL.'?>', true);
            $textvar = preg_replace("/\R|<br>/", "", $textvar);
        }
        return $textvar;
    }
}
