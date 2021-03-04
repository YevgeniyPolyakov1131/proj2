<?php

/**
 * Classe Contrôleur des clients
 *
 */

class Compteur {

	public function getCompteurs() {
		$compteurs = Compteurs::getAll();
		echo json_encode($compteurs);
	}

	public function postWebDiffusionNum() {

		$compteurs["ret"] = Compteurs::postCompteur($_POST);
		
		$compteurs["compteurs"] = Messages::getAll();;
		echo json_encode($compteurs);
	}

}