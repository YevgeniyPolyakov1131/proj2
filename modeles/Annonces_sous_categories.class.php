<?php
class Annonces_sous_categories extends Model{

    protected $fillAttributes = ['annonce_id','sous_categorie_id'];

    public static function getAllAnnonces_sous_categories(){

        return Annonces_sous_categories::getAll();

    }

    public static function getAnnonce_sous_categorie($id){

        return Annonces_sous_categories::getItem($id);
        
    }

    public function putAnnonce_sous_categorie($elmClass = null){

        if($elmClass == null) Annonces_sous_categories::putItem($this); else Annonces_sous_categories::putItem($elmClass,$this); 

    }

    public function postAnnonce_sous_categorie(){

        return Annonces_sous_categories::postItem($this);

    }

    public function deleteAnnonce_sous_categorie(){

        Annonces_sous_categories::deleteItem($this);

    }

    public static function whereAnnonces_sous_categories($field, $sign, $val){

        return Annonces_sous_categories::where($field,$sign,$val);        
        
    }  


}

?>