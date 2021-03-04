<?php

/**
 * Classe Routeur
 * analyse l'url et exécute la méthode associée  
 *
 */
class Routeur {
	private $routes = [
  	//   action,    url,                       classe,         méthode
		["GET",    	"",  				       "Accueil",      "index"],
		["GET",     "annonces/:id",			   "Annonce",      "showAnnonce"],		
		["POST",    "annonces/:id",			   "Annonce",      "showAnnonce"],		
		["GET",     "annonces/cat/:id",        "Annonce",      "showByCategory"],
		["GET",     "annonces/souscat/:id",    "Annonce",      "showBySubCategory"],
		["GET",  	"annonces/supprimer/:id",  "Annonce",      "deleteAnnonce"],
		["POST",    "annonces/souscat/:id",    "Annonce",      "favoris"],
		["POST",    "annonces/cat/:id",        "Annonce",      "favoris"],
		["GET",    	"villes/:id",		       "Ville",        "getVillesParProvince"],
		["GET",    	"allFavoris",		       "Favori",       "getAllFavoris"],
		["GET",    	"favori",		       	   "Favori",       "getFavoris"],
		["GET",    	"favorisExiste/:id",	   "Favori",       "getFavori"],
		["POST",    "favori",		       	   "Favori",       "postFavoris"],
		["DELETE",  "favori/:id",		       "Favori",       "deleteFavoris"],
		["GET",    	"inscription",		       "User",         "getFormInscription"],
		["POST",   	"inscription",		       "User",         "postUtilisateur"],
		["GET",    	"connexion",		       "User",         "getFormConnexion"],
		["POST",   	"connexion",		       "User",         "login"],
		["GET",    	"deconnexion",		       "User",         "logoff"],
		["GET",   	"ajouterAnnonce",		   "Annonce",      "ajoutAnnoncePage"],
		["POST",   	"ajouterAnnonce",		   "Annonce",      "ajoutAnnonce"],
		["GET",     "modifierAnnonce/:id",	   "Annonce",      "modifierAnnoncePage"],
		["POST",   	"modifierAnnonce/:id",	   "Annonce",      "modifierAnnonce"],
		["GET",     "compte/annonces",         "Annonce",      "listeAnnonces"],
		["GET",     "profil",         	   	   "User",         "profil"],
		["POST",    "profil",         	   	   "User",         "profilImage"],
		["GET",     "modifier/compte",     	   "User",         "UsagerModifiable"],
		["POST",    "modifier/compte", 		   "User",         "modifier"],
		["GET",    	"messages" ,               "Clavardage",   "getMessages"],
		["GET",    	"chats" ,                  "Clavardage",   "getAllMessages"],
		["POST",   	"chats",                   "Clavardage",   "postMessages"],
		["GET",    	"compteur",                "Compteur",     "getCompteurs"],
		["POST",   	"compteur",                "Compteur",     "postWebDiffusionNum"],
		
  	];

  	const BASE_URI = "\/proj2\/";

  	const ERROR_RESSOURCE  = 1;
  
	/**
	 * Constructeur qui valide l'URI
	 * et instancie la méthode du contrôleur correspondante
	 *
	 */
	public function __construct() {
		try {
			// balayage du tableau des routes 
			foreach ($this->routes as $route) {

				$routeAction  = $route[0];
				$routeUrl     = $route[1]; 
				$routeClasse  = $route[2];
				$routeMethode = $route[3]; 
				// contrôle de l'url si l'action coïncide 
				if ($_SERVER["REQUEST_METHOD"] === $routeAction) {
					
					// on enlève BASE_URI et le query string de l'url reçue  
			  		$url = preg_replace("/^".self::BASE_URI."([^?]*)\??.*$/", "$1", $_SERVER["REQUEST_URI"]); 
					// on modifie l'url du tableau routes
					// pour remplacer les mots clés précédés du caractère ":"
					// par un motif d'expression régulière
					// qui va permettre de contrôler l'url reçue
					// et d'en extraire les variables associées aux mots clés
					$regexp = preg_replace("/:[^\/]+/","([^/]+)",$routeUrl); 
					$regexp = "/^".preg_replace("/\//","\/",$regexp)."$/";

					if (preg_match($regexp, $url, $matches)) {
						
						// on enlève le premier élément qui est l'url contrôlée
						array_shift($matches); 
						
						// on exécute la méthode associée à l'url
						$oRouteClasse = new $routeClasse(); 
						$oRouteClasse->$routeMethode(...$matches);  
						exit;
			  		}
				}
		  	}
			
			// aucune route ne correspond à l'url
		  	throw new exception (self::ERROR_RESSOURCE);
		}
		catch (Exception $e) {
			$this->erreur($e->getMessage());
		}
	}

	/**
	 * Méthode qui envoie un compte-rendu d'erreur
	 *
	 */
	public static function erreur($erreur) {
		$message = '';
		if ($erreur == self::ERROR_RESSOURCE) {
			// filtrage de la méthode HTTP OPTIONS utilisée pour le cross-domain avec angular
			if  ($_SERVER["REQUEST_METHOD"] != "OPTIONS") header('HTTP/1.1 400 Bad Request');
		} else {
			header('HTTP/1.1 500 Internal Server Error');
	  		$message = $erreur;
		}
		echo $message;
		exit;
  	}
}