<?php 


class Favori extends Controller{


    public function getAllFavoris(){


        $favoris = Favoris::getAllFavoris("Favoris",$_SESSION['usager_id']);

        echo json_encode($favoris);

        // return new Vue('annonces', ['favoris' => $favoris]);

    }

    public function getFavoris(){


        $reponse = Favoris::getfavoris("favoris",$_SESSION['usager_id']);
        echo json_encode($reponse);
        

    }
    public function getFavori($id){


        $reponse = Favoris::getFavori($id);
        echo json_encode($reponse);
        

    }


    public function postfavoris(){

        Favoris::postFavoris("favoris", $_POST);
            
        $reponse = Favoris::getfavoris("favoris",$_POST['usager_id']);
        echo json_encode($reponse);

        
    }

    public function deleteFavoris($client){

        $reponse = Favoris::deleteFavori($client, $_SESSION['usager_id']);
        echo json_encode($reponse);
        

    }



}