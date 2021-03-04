<?php

class Usagers extends Model{

    protected $fillAttributes = ['usager_nom','usager_prenom','usager_courriel','usager_mdp','usager_telephone','usager_localite','usager_url','usager_photo_url'];

    public static function getAllUsagers(){

        return Usagers::getAll();

    }

    public static function getUsager($id){

        return Usagers::getItem($id);
        
    }

    public function putUsager($elmClass = null){

        // TraceDebug::log(json_encode($elmClass));
        // TraceDebug::log(json_encode($this));

        // Usagers::putItem($this); 
        if($elmClass == null) Usagers::putItem($this); else Usagers::putItem($elmClass,$this);  

    }

    public function postUsager(){

        return Usagers::postItem($this);

    }

    public function deleteUsager(){

        Usagers::deleteItem($this);

    }

    public static function whereUsager($field, $sign, $val){

        return Usagers::where($field,$sign,$val);        
        
    }   



}


?>