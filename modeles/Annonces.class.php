<?php

class Annonces extends Model{

    protected $fillAttributes = ['annonce_titre',
                                 'annonce_description',
                                 'annonce_prix',
                                 'usager_date',
                                 'usager_id',
                                 'ville_id',
                                 'image_id'];

    public static function getAllAnnonces(){

        return Annonces::join('images','to')->
                         join('villes','to')->getAll();

    }

    
    public static function getAnnonce($id){
        
        return Annonces::join('images','to')->
                         join('usagers','to')->
                         join('villes','to')->getItem($id);
        
    }

    public static function getAnnonceJoinSousCategorie($id){

        return Annonces::join('annonces_sous_categories,sous_categories','many')->
                         join('images','to')->
                         join('villes','to')->getItem($id);

    }
    
    public static function getcompteAnnonces($utilisateur){

        return Annonces::join('images','to')->
                         join('villes','to')->getAll()->where('usager_id','=',$utilisateur);

    }
/* ----------------------------- modifier annonce ---------------------------- */

    public function putAnnonce($elmClass = null){

        if($elmClass == null) Annonces::putItem($this); else Annonces::putItem($elmClass,$this);

    }

/* ----------------------------- ajouter annonce ---------------------------- */
    
    public function postAnnonce(){

        return Annonces::postItem($this);

    }

    public function deleteAnnonce(){

        Annonces::deleteItem($this);

    }

    public static function whereAnnonce($field, $sign, $val){

        return Annonces::where($field,$sign,$val);        
        
    }

    public static function getAnnoncesParSousCategorie($id){

        return Annonces::join('annonces_sous_categories,sous_categories','many')->
                         join('images','to')->
                         join('villes', 'to')->
                         getAll()->where('sous_categorie_id','=',$id);                         

    }

    public static function getAnnoncesParCategorie($id){

        return Sous_categories::join('categories_sous_categories,categories','many')->
                                join('annonces_sous_categories,annonces','many')->
                                join('annonces,villes,images','with')->
                                getAll()->where('categorie_id','=',$id);                         

    }
    


 



    

}

?>