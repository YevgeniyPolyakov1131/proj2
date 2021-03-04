<?php

class Vue {
  
    private $vue;
    private $titre; // Titre de la vue (défini dans le fichier vue)

    /**
     * Constructeur qui génère et affiche la page html complète associée à la vue
     * --------------------------------------------------------------------------
     *
     */
    public function __construct($vue, $donnees=array(), $gabarit="gabarit") {
        
        $this->vue = $vue;
        $fichierVue = "vues/".$vue.".php";
        
        // Génération de la partie spécifique de la page
        $contenu = $this->genererFichier($fichierVue, $donnees);
        
        // Génération du gabarit commun utilisant la partie spécifique
        $page = $this->genererFichier('vues/'.$gabarit.'.php',
                                     array('titre' => $this->titre, 'contenu' => $contenu));
        
        // Renvoi de la vue au navigateur
        echo $page;
    }

    /**
     * Méthode qui génère un code html à partir d'un fichier en fusionnant des données
     * -------------------------------------------------------------------------------
     *
     */
    private function genererFichier($fichier, $donnees) {
        if (file_exists($fichier)) {
            
            // Rend les éléments du tableau $donnees accessibles dans la vue
            extract($donnees);
            
            // Démarrage de la temporisation de sortie
            ob_start();
            
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $fichier;
            
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
            
        } else {
            throw new Exception("Fichier '$fichier' introuvable.");
        }
    }

    private function url($add = ''){

        $arr_split = explode('/',$_SERVER['SCRIPT_FILENAME']);

        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/';
        if($arr_split[count($arr_split)-2] != 'www'){

            $url .= $arr_split[count($arr_split)-2];

        }

        $url .= '/' . $add;

        return $url;
        
    }

    private function usagerConnecte(){

        if(isset($_SESSION['usager_id'])) return true; else return false;

    }

    private function getUsagerId(){

        if(isset($_SESSION['usager_id'])) return $_SESSION['usager_id']; else return false;

    }

}