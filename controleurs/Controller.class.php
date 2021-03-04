<?php

class Controller{

// public static $errors = null;    

// public function __construct($errors = null){

//     self::$errors = $errors;

// }    

public function validate($attributes=null){

    $valide = true;
    $errors = new Errors($_POST);

    if($attributes !== null){

        foreach($attributes as $key => $value){

            $arr = explode('|',$value);
            foreach($arr as $verify){

                if($verify == "required"){

                    if(isset($_POST[$key])){
                        if($_POST[$key] == ""){
                            $valide = false;                            
                            $errors->{$key."_error"} = 'Champ ne peut pas être vide';                            
                        }
                    }                    

                }

                if(preg_match('/min/',$verify)){

                    

                }

                if(preg_match('/^confirm:/',$verify)){

                    if(isset($_POST[$key])){ 
                        if($_POST[$key] != $_POST[substr($verify, 8)]){
                            $valide = false;
                            $errors->{$key."_error"} = 'Champs ne sont pas similaires';                          
                        }
                    }                    

                    

                }                

                

            }
            

        }


    }

    if(!$valide){
        
        $errors->{'hasErrors'} = true;    
        
    }else $errors->{'hasErrors'} = false;    

    return $errors;


}

public function uploadImage($nom, $id_usager, $id_annonce){

    // creer le dossier d'un utilisateur s'il n'est pas existe
    if (!file_exists($this->url_local("images/usagers/".$id_usager."/"))) {
        mkdir($this->url_server("images/usagers/".$id_usager."/"), 0777, true);
    }

    // creer le dossier d'un annonce s'il n'est pas existe
    if (!file_exists($this->url_local("images/usagers/".$id_usager."/".$id_annonce."/"))) {
        mkdir($this->url_local("images/usagers/".$id_usager."/".$id_annonce."/"), 0777, true);
    }   

    $target_dir = $this->url_local("images/usagers/".$id_usager."/".$id_annonce."/");
    $target_file = $target_dir . basename($nom.'.jpg');
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$nom]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        // echo "Sorry, file already exists.";
        $uploadOk = 1;
    }
    // Check file size
    if ($_FILES[$nom]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$nom]["tmp_name"], $target_file)) {
            // echo "The file ". basename( $_FILES[$nom]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
}

public function url_local($add = ''){

    $arr_split = explode('/',$_SERVER['SCRIPT_FILENAME']);

    $url = '';

    for($i=0; $i < count($arr_split)-1; $i++){

        $url .= $arr_split[$i] . "/";

    }

    $url .=  $add; 

    return $url;
    
}

public function url_server($add = ''){

    $arr_split = explode('/',$_SERVER['SCRIPT_FILENAME']);

    $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/';
    if($arr_split[count($arr_split)-2] != 'www'){

        $url .= $arr_split[count($arr_split)-2];

    }

    $url .= '/' . $add;

    return $url;
    
}


}



?>