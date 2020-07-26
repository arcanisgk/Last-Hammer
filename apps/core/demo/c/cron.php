<?php
class Class_Cron
{
    public function Task()
    {
        try {
            /*
			CORE::$ObjClass['GEN']['VARSMANAGER']->VarExportCDM('Hola Jovanka Mejorate!');
			CORE::$ObjClass['GEN']['VARSMANAGER']->VarExportCDM($_POST);
			*/
            $this->vida();
            //throw new Exception("Esta es una prueba de Error por Punto de Control.");
        } catch (Exception $e) {
            CORE::$ObjVar['SIS']['ERROR']['TYPE'] = 2;
            CORE::$ObjVar['SIS']['ERROR']['ARR']  = $e;
            CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
        }
    }
}
