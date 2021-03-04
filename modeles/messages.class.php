<?php
class Messages extends Model{

    // protected $fillAttributes = ['Message_url','Message_description_big'];

    public static function getAllMessages(){

        return Messages::getAll();

    }

    public static function getMessage($id){

        return Messages::getItem($id);
        
    }

    public function putMessage(){

        Messages::putItem($this);   

    }

    public function postMessage(){

        return Messages::postItem($this);

    }

    public function deleteMessage(){

        Messages::deleteItem($this);

    }

    public static function whereMessage($field, $sign, $val){

        return Messages::where($field,$sign,$val);        
        
    }   



}