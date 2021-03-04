<?php

/**
 * Classe Contrôleur 
 *
 */

class Accueil
{

	/**
	 * Accueil
	 *
	 */
	public function index()
	{


		$annonces = Annonces::getAllAnnonces()->paginate(8); 

		/* ---------------------------- suprrimer Annonce ---------------------------- */
		if(isset($_GET['supprimer'])){ 
            $supprimerAnnonce = new Annonce;
            $supprimerAnnonce->supprimerAnnonce($_GET['supprimer']);
			$annonces = Annonces::getAllAnnonces()->paginate(8);
		} 

		/* ---------------------------- filtre RECHERCHE ---------------------------- */
		if (isset($_GET['motCle'])) $annonces = Annonces::join('images','images.annonce_id','annonces.annonce_id')->join('villes','to')->whereAnnonce('annonce_titre ', 'LIKE ', "%" . $_GET['motCle'] . '%')->paginate(8);

		/* ------------------------------ filtre VILLE ------------------------------ */
		if(isset($_GET['ville'])) $annonces = Annonces::join('images', 'images.annonce_id', 'annonces.annonce_id')->whereAnnonce('ville_id', '=',$_GET['ville'])->paginate(8);
	  
		$categories = Categories::getAllCategories();
        $sous_categories = Sous_categories::getAllSousCategoriesJoined();	
        $provinces = Provinces::getAllProvinces();

		$villes = Villes::getVillesByProvince((isset($_GET['province'])) ? $_GET['province'] : 1);
		return new Vue("accueil", array('annonces' => $annonces, 'categories' => $categories, 'sous_categories' => $sous_categories, 'provinces' => $provinces,'villes'=>$villes));
	}

	// ,'sousCategories'=>$sousCategories


}
