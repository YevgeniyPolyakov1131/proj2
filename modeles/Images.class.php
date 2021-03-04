<?php
class Images extends Model{

    protected $fillAttributes = ['image_url','image_description_big'];

    public static function getAllImages(){

        return Images::getAll();

    }

    public static function getImage($id){

        return Images::getItem($id);
        
    }

    public function putImage(){

        Images::putItem($this);   

    }

    public function postImage(){

        return Images::postItem($this);

    }

    public function deleteImage(){

        Images::deleteItem($this);

    }

    public static function whereImage($field, $sign, $val){

        return Images::where($field,$sign,$val);        
        
    }   



}

?>