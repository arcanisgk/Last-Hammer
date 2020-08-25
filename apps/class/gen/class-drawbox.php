<?php

class ClassDrawboxManager
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self ::$instance instanceof self) {
            self ::$instance = new self;
        }
        return self ::$instance;
    }

    public function drawBoxes($source, $nlHeader = 0, $nlFooter = 0, $highlight = false, $limitlen = 0)
    {
        /*Check if variable is an string to convert*/
        $source = (is_string($source) ? preg_split('/\r\n|\r|\n/', rtrim($source)) : $source);
        /*Check if is running in CLI*/
        $is_cli = (php_sapi_name() == 'cli' ? true : false);
        /*Box Output*/
        $tl = html_entity_decode('╔', ENT_NOQUOTES, 'UTF-8'); // top left corner
        $tr = html_entity_decode('╗', ENT_NOQUOTES, 'UTF-8'); // top right corner
        $bl = html_entity_decode('╚', ENT_NOQUOTES, 'UTF-8'); // bottom left corner
        $br = html_entity_decode('╝', ENT_NOQUOTES, 'UTF-8'); // bottom right corner
        $v = html_entity_decode('║', ENT_NOQUOTES, 'UTF-8'); // vertical wall
        $h = html_entity_decode('═', ENT_NOQUOTES, 'UTF-8'); // horizontal wall
        $hs = html_entity_decode('─', ENT_NOQUOTES, 'UTF-8'); // horizontal wall single
        $ls = html_entity_decode('╟', ENT_NOQUOTES, 'UTF-8'); // left separator
        $rs = html_entity_decode('╢', ENT_NOQUOTES, 'UTF-8'); // right separator
        /*Get highlight for environment*/
        $cli_c_hf = '';
        $cli_c_r = '';
        $cli_EOL = '';
        $preStart = '';
        $preEnd = '';
        if ($highlight) {
            if ($is_cli) {
                $cli_c_hf = chr(27) . '[1;42m';
                $cli_c_r = chr(27) . '[1;32m';
                $cli_EOL = chr(27) . '[0m';
            } else {
                $preStart = "<pre style='font-family: monospace'>" . PHP_EOL;
                $preEnd = PHP_EOL . "</pre>";
            }
        }
        /*Calculate if the Horizontal limit is correct.*/
        $lenS = max(array_map(function ($el) {
            return mb_strlen(preg_replace('#\\e[[][^A-Za-z]*[A-Za-z]#', '', $el));
        }, $source));
        $longest = ($lenS > $limitlen ? $lenS : $limitlen);

        /*Count the number of Lines to get footer cal*/
        $nLines = count($source);
        /*Start the some variables for cal*/
        $i = 0;
        $calcfooter = $nLines - $nlFooter;
        $result = '';
        $f_top = $tl . str_repeat($h, $longest + 2) . $tr;
        $f_button = $bl . str_repeat($h, $longest + 2) . $br;
        /*Start the analysis*/
        $result .= ($highlight && $is_cli && 0 != $nlHeader ? $cli_c_hf . $f_top . $cli_EOL . PHP_EOL : $cli_c_r . $f_top . $cli_EOL . PHP_EOL);
        foreach ($source as $line) {
            $addEmpty = '';
            $len = mb_strlen(preg_replace('#\\e[[][^A-Za-z]*[A-Za-z]#', '', $line));
            //$line     = preg_replace('#\\e[[][^A-Za-z]*[A-Za-z]#', '', $line);
            $linetxt = '';
            /*Source Line Given Analysis*/

            if (0 != $nlHeader && $i < $nlHeader) {
                $line = str_pad($line, $longest, ' ', STR_PAD_BOTH);
                $linetxt .= $cli_c_hf . $v . ' ' . $line . ' ' . $v . $cli_EOL;
            } elseif (0 != $nlFooter && $calcfooter == $i) {
                $line = str_pad($line, $longest, ' ', STR_PAD_BOTH);
                $linetxt .= $cli_c_hf . $v . ' ' . $line . ' ' . $v . $cli_EOL;
            } elseif ($len <= $longest) {
                $addEmpty = str_repeat(' ', $longest - $len);
                $linetxt .= $cli_c_r . $v . ' ' . $line . $addEmpty . ' ' . $v . $cli_EOL;
            }
            if (0 != $nlHeader && $i == $nlHeader - 1) {
                //$linetxt .= PHP_EOL.$cli_c_r.$v.str_repeat(' ', $longest + 2).$v.$cli_EOL;
                $linetxt .= PHP_EOL . $cli_c_hf . $ls . str_repeat($hs, $longest + 2) . $rs . $cli_EOL . PHP_EOL;
            } elseif (0 != $nlFooter && $calcfooter - 1 == $i) {
                $linetxt .= PHP_EOL . $cli_c_r . $v . str_repeat(' ', $longest + 2) . $v . $cli_EOL;
                $linetxt .= PHP_EOL . $cli_c_hf . $ls . str_repeat($hs, $longest + 2) . $rs . $cli_EOL . PHP_EOL;
            } else {
                $linetxt .= PHP_EOL;
            }
            $result .= $linetxt;
            ++$i;

        }
        $result .= ($highlight && $is_cli && 0 != $nlFooter ? $cli_c_hf . $f_button . $cli_EOL : $cli_c_r . $f_button . $cli_EOL . PHP_EOL);
        $result = ($highlight && !$is_cli ? $preStart . $result . $preEnd : $result);
        return $result;
    }
}
