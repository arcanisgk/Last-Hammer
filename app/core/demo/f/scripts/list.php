<?php
class Class_List
{
    public function GetListOfForm()
    {
        try {
            //Analisis del Script php
            //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            //CORE::$ObjVar['DISPLAY']['HTML']['LIST']['CRUD'] = False; //Para Desactivar el Crud
            //CORE::$ObjVar['DISPLAY']['HTML']['LIST']['*****INDICE*****'] = Variable o Funcion.
            //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        } catch (Exception $e) {
            CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
            CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
        }
    }

    public function GetListOfSearchs()
    {
        try {
            foreach ($_POST as $key => $value) {
                ${$key} = CORE::$ObjClass['GEN']['VARSMANAGER']->GetCleanPOST(['key' => $key, 'value' => $value]);
            }
            //Analisis del Script php
            //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            //CORE::$ObjVar['DISPLAY']['HTML']['LIST']['*****INDICE*****'] = Variable o Funcion.
            //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        } catch (Exception $e) {
            CORE::$ObjVar['SIS']['ERROR']['ARR'] = $e;
            CORE::$ObjClass['GEN']['ERRORMANAGER']->GetError();
        }
    }
}
