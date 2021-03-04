<?php

class User extends Controller{

 
    public function getFormInscription(){

        if(isset($_GET['supprimer'])){ 
                       
            $supprimerAnnonce = new Annonce;
            $supprimerAnnonce->supprimerAnnonce($_GET['supprimer']);
            
            $controller = new Accueil;
            return $controller->index();
        }

        return new Vue('inscription');                

    }

    public function postUtilisateur(){

        $data = $this->validate(['usager_courriel' => 'required',
                                 'usager_courriel_confirm' => 'confirm:usager_courriel',
                                 'usager_mdp' => 'required',
                                 'usager_mdp_confirm' => 'confirm:usager_mdp']);
        if(!Usagers::whereUsager('usager_courriel','=',$data->usager_courriel)->empty()) {

            $data->usager_courriel_error = 'courriel existe déjà';
            $data->hasErrors = true;
            
        }
        if($data->hasErrors){
            
            return new Vue('inscription',['data' => $data]);

        }else{

            $usager = new Usagers($data);
            $usager->usager_mdp = Encryption::encryptPassword($usager->usager_mdp);
            $last_id = $usager->postUsager();

            $_SESSION['usager_id'] = $last_id;
            $usager = new User;
            return $usager->profil();            

        }

    }

    public function getFormConnexion(){

        if(isset($_GET['supprimer'])){ 
                       
            $supprimerAnnonce = new Annonce;
            $supprimerAnnonce->supprimerAnnonce($_GET['supprimer']);
            
            $controller = new Accueil;
            return $controller->index();
        }

        return new Vue('connexion');

    }

    public function login(){

        $data = $this->validate(['usager_courriel' => 'required',
                                 'usager_mdp' => 'required']);
        $usagers = Usagers::whereUsager('usager_courriel','=',$data->usager_courriel);
        if(!$usagers->empty()){
            $usager = $usagers->where('usager_mdp','=',Encryption::encryptPassword($_POST['usager_mdp']));
            if($usager->empty()){

                $data->usager_mdp_error = 'Mot de passe est incorrecte!!!';
                $data->hasErrors = true;

            }

        }else{

            if(!isset($data->usager_courriel_error))
            $data->usager_courriel_error = "Courriel n'existe pas!!!";
            $data->hasErrors = true;

        }

        if($data->hasErrors){
            
            return new Vue('connexion',['data' => $data]);

        }else{

            $_SESSION['usager_id'] = $usager->{0}->usager_id;

            
            $controller = new Accueil;
            return $controller->index();

        }

    }

    public function logoff(){

        !session_destroy();
        unset($_SESSION);

        $controller = new Accueil;
        return $controller->index();

    }

    public function profil(){
        if (isset($_SESSION['usager_id'])){
            
            $usager = Usagers::getUsager($_SESSION['usager_id']);

            return new Vue('profil',["usager"=> $usager]);
        }else{  

            echo "vous devez être connecté";
            $controller = new Accueil;
            return $controller->index(); 
        }

    }



    public function UsagerModifiable(){

        
        if (isset($_SESSION['usager_id'])){

            $usager = Usagers::getUsager($_SESSION['usager_id']);

            if($usager != false){
                        if($_SESSION['usager_id'] === $usager->usager_id || $_SESSION['usager_id'] < 0 ) { 

                            return new Vue('modifierUsager',["usager"=> $usager]);

                            }else{ echo "Vous ne pouvez Modifier que votre compte"; }
                        }else{ echo "Vous ne pouvez Modifier que votre compte";}
        }else{ echo " Vous ne pouvez effectuer cet action"; }



    }

    public function modifier(){



        // TraceDebug::log(json_encode($this));
        
        $data = $this->validate(['usager_nom' => 'required',
                                    'usager_prenom' => '',
                                    'usager_courriel' => 'required',
                                    'usager_telephone' => '',
                                    'usager_localite' => '']);

            if($data->hasErrors){

                $usager = Usagers::getUsager($_SESSION['usager_id']);
                return new Vue('modifierUsager',["usager"=> $usager,'data' => $data]);

            }else{

                     $utilisateur = Usagers::getUsager($_SESSION['usager_id']);
                     $utilisateur->putUsager(new Usagers($data));
                    
                     $usager = Usagers::getUsager($_SESSION['usager_id']);

                     $controller = new User;
                     return $controller->profil();
                     
            }      
                    
        }

        public function profilImage(){
            
            // TraceDebug::log(json_encode($_FILES));
            if($_FILES['file']["name"] != ''){

                $test = explode(".", $_FILES['file']["name"]);
                $extension = end($test);
                // $name = rand(100,999).'.'.$extension;
                $utilisateur = Usagers::getUsager($_SESSION['usager_id']);

                $usagerNom = $utilisateur->usager_nom.$utilisateur->usager_nom;
                $name = $usagerNom.'_'.rand(100,999).'.'.$extension;

                if (!file_exists('images/profil')) {
                    mkdir('images/profil', 0777, true);
                }

                $location = 'images/profil/'.$name;

                move_uploaded_file($_FILES["file"]["tmp_name"], $location);
                $data = array('usager_photo_url'=>$location);
                
                $utilisateur->putUsager(new Usagers($data));
                $usager = Usagers::getUsager($_SESSION['usager_id']);
                echo json_encode($usager);
            }
        }    
        
    }






?>