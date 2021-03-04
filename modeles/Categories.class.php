<?php

class Categories extends Model {

    public static function getAllCategories(){

        return Categories::getAll();

    }

    public static function getCategorie($id){

        return Categories::getItem($id);
        
    }

    public function putCategorie(){

        Categories::putItem($this);

    }

    public function postCategorie(){

        Categories::postItem($this);

    }

    public function deleteCategorie(){

        Categories::deleteItem($this);

    }

    public static function whereCategorie($field, $sign, $val){

        return Categories::where($field,$sign,$val);        
        
    }


}

?>