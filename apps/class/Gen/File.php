<?php

namespace IcarosNet\LastHammer\Gen;
class File
{
    private static $instance = null;

    public static function _getInstance()
    {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function crateLocalFile($filepath)
    {
        $file = fopen($filepath, 'w');
        fwrite($file, '');
        fclose($file);
        $this->setPermission($filepath);
    }

    public function createLocalDirectory($directory)
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $this->setPermission($directory);
    }

    public function fileRead($filepath)
    {
        return fopen($filepath, 'r');
    }

    public function getFileContent($path, $data = '')
    {
        if (!file_exists($path)) {
            $file = false;
        } else {
            ob_start();
            include $path;
            $file = ob_get_contents();
            ob_end_clean();
        }
        return $file;
    }

    public function requireFile($file)
    {
        return require_once $file;
    }

    public function validateLocalDirectory($directory)
    {
        return (is_dir($directory)) ? true : false;
    }

    public function validateLocalFile($filepath)
    {
        return (file_exists($filepath)) ? true : false;
    }

    public function writeFile($cont, $path)
    {
        $file = fopen($path, "a+");
        fwrite($file, $cont."\n") || die("Could not write to Archive!");
        fclose($file);
    }

    private function setPermission($filepath)
    {
        chmod($filepath, 0777);
    }
}
