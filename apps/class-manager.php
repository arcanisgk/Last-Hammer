<?php
class ClassManager
{
    private static $instance = null;

    public function LoadClass()
    {
        $classPaths = [
            'GEN' => PATHS['CLASSGEN'],
            'MVC' => PATHS['CLASSMVC']
        ];
        $this->requireClassFile(PATHS['CLASSEXT'].'vendor/autoload.php');
        $this->ClassLoader($classPaths);
    }

    public static function _getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function CheckFileIntegrity($file)
    {
        $dl    = ['st' => false, 'msg' => ''];
        $smg1  = '';
        $fileR = file($file);
        $c     = 1;
        foreach ($fileR as $line) {
            if (!strlen(trim($line))) {
                $smg1 .= 'Incorrect space/Linebreak found file: '.$file.EOL_SYS.'Line: '.$c.EOL_SYS;
                $dl['st'] = true;
                ++$c;
            } else {
                break;
            }
        }
        $dl['msg'] = $smg1;
        return $dl;
    }

    private function ClassLoader($classPaths)
    {
        foreach ($classPaths as $key => $path) {
            $dl          = [];
            $class_store = &CoreApp::$oclass[$key];
            $files       = array_diff(
                scandir($path, 1),
                ['..', '.']
            );
            foreach ($files as $key => $name) {
                if (strpos($name, 'class-') !== false) {
                    $fl_dir = $path.$name;
                    $dl     = $this->CheckFileIntegrity($fl_dir);
                    if (!$dl['st']) {
                        $this->requireClassFile($fl_dir);
                        $name = explode("-", preg_replace('#\.php#', '', $name));
                        foreach ($name as $key => $cl_name) {
                            $name[$key] = ucfirst(strtolower($cl_name));
                        }
                        $new_name_class = implode('', $name);
                        $instance_class = strtoupper(
                            preg_replace('#\Class#', '', $new_name_class)
                        );
                        $new_name_class .= 'Manager';
                        $class_store[$instance_class] = $new_name_class::_getInstance();
                    } else {
                        echo
                            'PHP files cannot have line breaks at the beginning '.
                            'or end.<br> There is a problem with this file: <b> '.
                            PATHS['CLASSGEN'].$name.'</b> <br> <br>'.
                            $dl['msg'];
                        die;
                    }
                }
            }
        }
    }

    private function requireClassFile($file)
    {
        return require_once $file;
    }
}
