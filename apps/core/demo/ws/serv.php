<?php
class Class_Serv
{
    public function Service()
    {
        try {
            /*
			CORE::$ObjClass['GEN']['VARSMANAGER']->VarExportCDM('Hola Jovanka Mejorate!');
			CORE::$ObjClass['GEN']['VARSMANAGER']->VarExportCDM($_POST);
			*/
            //CORE::$ObjClass['GEN']['VARSMANAGER']->VarExportCDM($_POST);
            //$this->vida();
            //echo 'HOLAAAAAA';
            //throw new Exception("Esta es una prueba de Error por alguna cagadita.");
        } catch (Exception $e) {
            CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 5;
            CORE::$ObjVar['SIS']['ERROR']['ARR']  = $e;
            CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
        }
    }
}
