<?php
class Compteurs extends Model{

    protected $fillAttributes = ['Compteur_url','Compteur_description_big'];

    public static function getAllCompteurs(){

        return Compteurs::getAll();

    }

    public static function getCompteur($id){

        return Compteurs::getItem($id);
        
    }

    public function putCompteur(){

        Compteurs::putItem($this);   

    }

    public function postCompteur(){

        return Compteurs::postItem($this);

    }

    public function deleteCompteur(){

        Compteurs::deleteItem($this);

    }

    public static function whereCompteur($field, $sign, $val){

        return Compteurs::where($field,$sign,$val);        
        
    }   



}