<?php

class sous_categories extends Model {

    public static function getAllSousCategories(){

        return sous_categories::getAll();

    }


    public static function getAllSousCategoriesJoined(){

        return sous_categories::join('categories_sous_categories,categories','many')->
                                join('annonces_sous_categories,annonces','many')->
                                groupBy('sous_categories.sous_categorie_id')->getAll();


    }

    public static function getSousCategorie($id){

        return sous_categories::getItem($id);
        
    }

    public function putSousCategorie(){

        sous_categories::putItem($this);

    }

    public function postSousCategorie(){

        sous_categories::postItem($this);

    }

    public function deleteSousCategorie(){

        sous_categories::deleteItem($this);

    }

    public static function whereSousCategorie($field, $sign, $val){

        return sous_categories::where($field,$sign,$val);        
        
    }


}

?>