<?php

class Annonce extends Controller
{


    public function showByCategory($id)
    {


        $annonces = Annonces::getAnnoncesParCategorie($id);
        
        /* ---------------------------- suprrimer Annonce ---------------------------- */
        if(isset($_GET['supprimer'])){ 
            $supprimerAnnonce = new Annonce;
            $supprimerAnnonce->supprimerAnnonce($_GET['supprimer']);
        
            $annonces = Annonces::getAnnoncesParCategorie($id);
        } 

            /* ---------------------------- filtre RECHERCHE ---------------------------- */
            if (isset($_GET['motCle'])) $annonces = Annonces::join('images','images.annonce_id','annonces.annonce_id')->join('villes','to')->whereAnnonce('annonce_titre ', 'LIKE ', "%" . $_GET['motCle'] . '%');

            
            /* ------------------------------ filtre VILLE ------------------------------ */
            if (isset($_GET['ville'])) $annonces = $annonces->where('ville_id','=',$_GET['ville']);
    
            /* ------------------------------- filtre PRIX ------------------------------ */
            if (isset($_GET['prixMax']) && isset($_GET['prixMin'])){

                if ($_GET['prixMax'] == "" && $_GET['prixMin'] !== "") $annonces = $annonces->where('annonce_prix','>=',$_GET['prixMin']);
                else if ($_GET['prixMin'] == "" && $_GET['prixMax'] !== "") $annonces = $annonces->where('annonce_prix','<=',$_GET['prixMax']);
                else if($_GET['prixMin'] !== "" && $_GET['prixMax'] !== "") $annonces = $annonces->where('annonce_prix','>=',$_GET['prixMin'])->where('annonce_prix','<=',$_GET['prixMax']);
            }
    
            /* ------------------------------- filtre DATE ------------------------------ */
            if (isset($_GET['dateMax']) && isset($_GET['dateMin'])){
    
                if ($_GET['dateMax'] == "" && $_GET['dateMin'] !== "")  $annonces = $annonces->where('usager_date','>=',$_GET['dateMin']);
                else if($_GET['dateMin'] == "" && $_GET['dateMax'] !== "")  $annonces = $annonces->where('usager_date','<=',$_GET['dateMax']);
                else if($_GET['dateMin'] !== "" && $_GET['dateMax'] !== "") $annonces = $annonces->where('usager_date','>=',$_GET['dateMin'])->where('usager_date','<=',$_GET['dateMax']);
    
            }
        
        $categories = Categories::getAllCategories();
        $sous_categories = Sous_categories::getAllSousCategoriesJoined();
        $provinces = Provinces::getAllProvinces();

        // TraceDebug::log(json_encode($favoris));
        
        $villes = Villes::getVillesByProvince((isset($_GET['province'])) ? $_GET['province'] : 1);

        return new Vue('annonces',['annonces' => $annonces,'categories'=> $categories,'sous_categories' => $sous_categories,'provinces' => $provinces, 'villes' => $villes, 'id_cat' => $id]);

    }

    public function showBySubCategory($id)
    {

        $annonces = Annonces::getAnnoncesParSousCategorie($id);

            /* ---------------------------- suprrimer Annonce ---------------------------- */
            if(isset($_GET['supprimer'])){ 

                $supprimerAnnonce = new Annonce;
                $supprimerAnnonce->supprimerAnnonce($_GET['supprimer']);
                $annonces = Annonces::getAnnoncesParSousCategorie($id);
            } 

            /* ---------------------------- filtre RECHERCHE ---------------------------- */
            if (isset($_GET['motCle'])) $annonces = Annonces::join('images','images.annonce_id','annonces.annonce_id')->join('villes','to')->whereAnnonce('annonce_titre ', 'LIKE ', "%" . $_GET['motCle'] . '%');
            
            /* ------------------------------ filtre VILLE ------------------------------ */
            if (isset($_GET['ville'])) $annonces = $annonces->where('ville_id','=',$_GET['ville']);
    
            /* ------------------------------- filtre PRIX ------------------------------ */
            if (isset($_GET['prixMax']) && isset($_GET['prixMin'])){

                if ($_GET['prixMax'] == "" && $_GET['prixMin'] !== "") $annonces = $annonces->where('annonce_prix','>=',$_GET['prixMin']);
                else if ($_GET['prixMin'] == "" && $_GET['prixMax'] !== "") $annonces = $annonces->where('annonce_prix','<=',$_GET['prixMax']);
                else if($_GET['prixMin'] !== "" && $_GET['prixMax'] !== "") $annonces = $annonces->where('annonce_prix','>=',$_GET['prixMin'])->where('annonce_prix','<=',$_GET['prixMax']);
            }
    
            /* ------------------------------- filtre DATE ------------------------------ */
            if (isset($_GET['dateMax']) && isset($_GET['dateMin'])){
    
                if ($_GET['dateMax'] == "" && $_GET['dateMin'] !== "")  $annonces = $annonces->where('usager_date','>=',$_GET['dateMin']);
                else if($_GET['dateMin'] == "" && $_GET['dateMax'] !== "")  $annonces = $annonces->where('usager_date','<=',$_GET['dateMax']);
                else if($_GET['dateMin'] !== "" && $_GET['dateMax'] !== "") $annonces = $annonces->where('usager_date','>=',$_GET['dateMin'])->where('usager_date','<=',$_GET['dateMax']);
    
            }

        $categories = Categories::getAllCategories();
        $sous_categories = Sous_categories::getAllSousCategoriesJoined(); 
        $provinces = Provinces::getAllProvinces();
     
        $villes = Villes::getVillesByProvince((isset($_GET['province'])) ? $_GET['province'] : 1);

        return new Vue('annonces', ['annonces' => $annonces, 'categories' => $categories, 'sous_categories' => $sous_categories, 'provinces' => $provinces, 'villes' => $villes,'id_sous_cat' => $id]);
    }

    public function listeAnnonces()
    {
        if (isset($_SESSION['usager_id'])){

            $annonces = Annonces::getAllAnnonces();

            /* ------------------------ usager non administrateur ----------------------- */

            if ($_SESSION['usager_id'] > 0)$annonces = Annonces::getcompteAnnonces($_SESSION['usager_id']);

                /* ---------------------------- suprrimer Annonce ---------------------------- */
                if(isset($_GET['supprimer'])){ 
                    $supprimerAnnonce = new Annonce;
                    $supprimerAnnonce->supprimerAnnonce($_GET['supprimer']);
                    ($_SESSION['usager_id'] > 0) ? $annonces = Annonces::getcompteAnnonces($_SESSION['usager_id']) : $annonces = Annonces::getAllAnnonces();
                } 
        
                /* ---------------------------- filtre RECHERCHE ---------------------------- */
                if (isset($_GET['motCle'])) $annonces = Annonces::join('images','images.annonce_id','annonces.annonce_id')->join('villes','to')->whereAnnonce('annonce_titre ', 'LIKE ', "%" . $_GET['motCle'] . '%');
                
                /* ------------------------------ filtre VILLE ------------------------------ */
                if (isset($_GET['ville'])) $annonces = $annonces->where('ville_id','=',$_GET['ville']);
        
                /* ------------------------------- filtre PRIX ------------------------------ */
                if (isset($_GET['prixMax']) && isset($_GET['prixMin'])){

                    if ($_GET['prixMax'] == "" && $_GET['prixMin'] !== "") $annonces = $annonces->where('annonce_prix','>=',$_GET['prixMin']);
                    else if ($_GET['prixMin'] == "" && $_GET['prixMax'] !== "") $annonces = $annonces->where('annonce_prix','<=',$_GET['prixMax']);
                    else if($_GET['prixMin'] !== "" && $_GET['prixMax'] !== "") $annonces = $annonces->where('annonce_prix','>=',$_GET['prixMin'])->where('annonce_prix','<=',$_GET['prixMax']);
                }
        
                /* ------------------------------- filtre DATE ------------------------------ */
                if (isset($_GET['dateMax']) && isset($_GET['dateMin'])){
        
                    if ($_GET['dateMax'] == "" && $_GET['dateMin'] !== "")  $annonces = $annonces->where('usager_date','>=',$_GET['dateMin']);
                    else if($_GET['dateMin'] == "" && $_GET['dateMax'] !== "")  $annonces = $annonces->where('usager_date','<=',$_GET['dateMax']);
                    else if($_GET['dateMin'] !== "" && $_GET['dateMax'] !== "") $annonces = $annonces->where('usager_date','>=',$_GET['dateMin'])->where('usager_date','<=',$_GET['dateMax']);
        
                }

            $categories = Categories::getAllCategories();
            $sous_categories = Sous_categories::getAllSousCategoriesJoined(); 
            $provinces = Provinces::getAllProvinces();
        
            $villes = Villes::getAllVilles((isset($_GET['province'])) ? $_GET['province'] : 1);

           
            return new Vue('annonces', ['annonces' => $annonces, 'categories' => $categories, 'sous_categories' => $sous_categories, 'provinces' => $provinces, 'villes' => $villes]);
        
        }else{  

            echo "vous devez être connecté";
            $controller = new Accueil;
            return $controller->index(); 
        }
    
   }

   


public function showAnnonce($id){


    /* ---------------------------- suprrimer Annonce ---------------------------- */
    if(isset($_GET['supprimer'])){ 

            $supprimerAnnonce = new Annonce;
            $supprimerAnnonce->supprimerAnnonce($_GET['supprimer']);
            
            $controller = new Accueil;
            return $controller->index();
    } 


    if(isset($_POST['submit'])){

        TraceDebug::log(json_encode($_POST));
        $to = "benjaminmaneno@hotmail.fr"; // this is your Email address
        $from = $_POST['email']; // this is the sender's Email address
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $subject = "Form submission";
        $subject2 = "Copy of your form submission";
        $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
        $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];
    
        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        mail($to,$subject,$message,$headers);
        mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
        echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
        // You can also use header('Location: thank_you.php'); to redirect to another page.
    }
    $usager = Usagers::getUsager(isset($_SESSION['usager_id']));
    $annonce = Annonces::getAnnonce($id);

    return new Vue('annonce',['annonce' => $annonce,'usager' => $usager, ]);    

 
}

public function ajoutAnnoncePage(){

    if (isset($_SESSION['usager_id'])){
        /* ---------------------------- suprrimer Annonce ---------------------------- */
        if(isset($_GET['supprimer'])){ 

            $supprimerAnnonce = new Annonce;
            $supprimerAnnonce->supprimerAnnonce($_GET['supprimer']);
            
            $controller = new Accueil;
            return $controller->index();
        } 

    $sous_categories = Sous_categories::getAllSousCategories();
    $villes = Villes::getAllVilles();

    return new Vue('ajoutAnnonce',['sous_categories' => $sous_categories, 'villes' => $villes]);   
    
    }else{  

        echo "vous devez être connecté";
        $controller = new Accueil;
        return $controller->index(); 
    }

}

public function ajoutAnnonce(){

    $data = $this->validate(['annonce_titre' => 'required',
                             'annonce_description' => 'required',
                             'annonce_prix' => 'required']);

    if($data->hasErrors){

        $sous_categories = Sous_categories::getAllSousCategories();
        $villes = Villes::getAllVilles();
        return new Vue('ajoutAnnonce',['sous_categories' => $sous_categories, 'villes' => $villes,'data' => $data]);        

    }else{

        $annonce = new Annonces($data); 
        $annonce->usager_date = date('Y-m-d');
        $last_id = $annonce->postAnnonce();
    
        if(isset($_FILES['img_base'])){ 
    
            $lien_base = $this->url_server('images/usagers/'.$_SESSION['usager_id'].'/'.$last_id); 
            $lien_img_base = "";           
            $lien_img_vide = $this->url_server('images/imageVide750x600.jpg');

            if($_FILES['img_base']['size'] > 0 && $_FILES['img_base']['size'] < 2000000){
                $this->uploadImage("img_base",$_SESSION['usager_id'],$last_id);                    
                $json_f = '{"img_base":"'.$lien_base.'/img_base.jpg'.'",';
                $lien_img_base = $lien_base.'/img_base.jpg';    
            }else{
                $json_f = '{"img_base":"'.$lien_img_vide.'",';
                $lien_img_base = $lien_img_vide;    
            }

            for($i=0; $i < 5; $i++){
                
                if(isset($_FILES['img_'.($i+1)])){     

                    if($_FILES['img_'.($i+1)]['size'] > 0 && $_FILES['img_'.($i+1)]['size'] < 2000000){
                    $this->uploadImage('img_'.($i+1),$_SESSION['usager_id'],$last_id);
                    $json_f .= '"img_'.($i+1).'":"'.$lien_base.'/img_'.($i+1).'.jpg"'.','; 
                    } else $json_f .= '"img_'.($i+1).'":"'.$lien_img_vide.'",';               
    
                }elseif($i < 3) $json_f .= '"img_'.($i+1).'":"'.$lien_img_vide.'",';
    
            }
            $json_f = substr($json_f,0,-1);
            $json_f .= '}';
    
            
            $image = new Images(['image_url' => $lien_img_base,'image_description_big' => $json_f]);
            $last_img_id = $image->postImage();
    
        }
        
        $annonce = Annonces::getAnnonce($last_id);
        $annonce->image_id = $last_img_id;
        $annonce->putAnnonce();
    
        $annonce_sous_cat = new Annonces_sous_categories(['annonce_id' => $last_id,'sous_categorie_id' => $data->sous_categorie_id]);
        $annonce_sous_cat->postAnnonce_sous_categorie();
    
        $controller = new Annonce;
        return $controller->showAnnonce($last_id);

    }

    
}


public function modifierAnnoncePage($id){
    if (isset($_SESSION['usager_id'])){
        $annonce = Annonces::getAnnonce($id);
        if($annonce != false){
            if($_SESSION['usager_id'] === $annonce->usager_id || $_SESSION['usager_id'] < 0 ) { 

                /* ---------------------------- suprrimer Annonce ---------------------------- */
                        if(isset($_GET['supprimer'])){ 
                        
                            $supprimerAnnonce = new Annonce;
                            $supprimerAnnonce->supprimerAnnonce($_GET['supprimer']);
                            
                            $controller = new Accueil;
                            return $controller->index();
                        } 
                
                $sous_categories = Sous_categories::getAllSousCategories();
                $villes = Villes::getAllVilles();
                

                $annonce = Annonces::getAnnonceJoinSousCategorie($id);

                return new Vue('modifierAnnonce',['data' => $annonce,'sous_categories' => $sous_categories, 'villes' => $villes]);  
            }else{  

                echo "Vous ne pouvez modifier que vos propre annonces ";
                $controller = new Accueil;
                return $controller->index(); 
            }
        }else{ 
            echo " l'annonce n'existe pas";
        }
    }else{  

        echo "vous devez être connecté";
        $controller = new Accueil;
        return $controller->index(); 
    }
}

public function modifierAnnonce($id){

    $data = $this->validate(['annonce_titre' => 'required',
                             'annonce_description' => 'required',
                             'annonce_prix' => 'required']);

    if($data->hasErrors){

        $sous_categories = Sous_categories::getAllSousCategories();
        $villes = Villes::getAllVilles();
        return new Vue('modifierAnnonce',['data' => $data,'sous_categories' => $sous_categories, 'villes' => $villes]);  

    }else{

        $annonce = Annonces::getAnnonce($id);

        $annonce->putAnnonce(new Annonces($data));

        $image = Images::getImage($annonce->image_id);

        $images = json_decode($image->image_description_big);

        if(isset($_FILES['img_base'])){ 
    
            $lien_base = $this->url_server('images/usagers/'.$_SESSION['usager_id'].'/'.$id); 
            $lien_img_base = "";           
            $lien_img_vide = $this->url_server('images/imageVide750x600.jpg');
            if($_FILES['img_base']['size'] > 0 && $_FILES['img_base']['size'] < 2000000){
                $this->uploadImage("img_base",$_SESSION['usager_id'],$id);                    
                $json_f = '{"img_base":"'.$lien_base.'/img_base.jpg'.'",';
                $lien_img_base = $lien_base.'/img_base.jpg';    
            }else{
                $json_f = '{"img_base":"'.$images->img_base.'",';
                $lien_img_base = $images->img_base;    
            }

        }else{

            $json_f = '{"img_base":"'.$images->img_base.'",';
            $lien_img_base = $images->img_base;               

        }


        for($i=0; $i < 5; $i++){
                
            if(isset($_FILES['img_'.($i+1)])){     

                if($_FILES['img_'.($i+1)]['size'] > 0 && $_FILES['img_'.($i+1)]['size'] < 2000000){
                    $this->uploadImage('img_'.($i+1),$_SESSION['usager_id'],$id);
                    $json_f .= '"img_'.($i+1).'":"'.$lien_base.'/img_'.($i+1).'.jpg"'.','; 
                }else{
                    if(isset($images->{'img_'.($i+1)})){
                        $json_f .= '"img_'.($i+1).'":"'.$images->{'img_'.($i+1)}.'",';                
                    }else{
                        $json_f .= '"img_'.($i+1).'":"'.$lien_img_vide.'",';
                    }
                } 
    
            }elseif($i < 3){
                if(isset($images->{'img_'.($i+1)})){
                    $json_f .= '"img_'.($i+1).'":"'.$images->{'img_'.($i+1)}.'",';
                }else{
                    $json_f .= '"img_'.($i+1).'":"'.$lien_img_vide.'",';
                }
            } 
    
        }
        
        $json_f = substr($json_f,0,-1);
        $json_f .= '}';
    
            
            
        $image->image_url = $lien_img_base;
        $image->image_description_big = $json_f;
        $image->putImage();       


        $annonce_sous_cat = Annonces_sous_categories::whereAnnonces_sous_categories('annonce_id','=',$id)->get();
        $annonce_sous_cat->sous_categorie_id = $data->sous_categorie_id;
        $annonce_sous_cat->putAnnonce_sous_categorie();
    
        $controller = new Annonce;
        return $controller->showAnnonce($id);        

    }                         

    
}


public function supprimerAnnonce($id){

        $annonce = Annonces::getAnnonce($id);

        if (isset($_SESSION['usager_id'])){
            if($annonce != false){
                        if($_SESSION['usager_id'] === $annonce->usager_id || $_SESSION['usager_id'] < 0 ) { 
                                $annonce->deleteAnnonce(); 
                            }else{ echo "Vous ne pouvez supprimer que vos annonces "; }
                        }else{ echo " l'annonce n'existe pas";}
        }else{ echo " Vous ne pouvez effectuer cet action"; }


}


}
