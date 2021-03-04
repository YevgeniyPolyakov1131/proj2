<?php
class Villes extends Model{

    public static function getAllVilles(){

        return Villes::getAll();

    }

    public static function getVillesByProvince($id)
    {

        return Villes::where("province_id","=",$id);

    }




}

?>