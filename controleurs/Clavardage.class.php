<?php

/**
 * Classe Contrôleur des clients
 *
 */

class Clavardage {

	public function getMessages() {
		$message = Messages::getAll();
		return new vue('messages');
	}

	public function getAllMessages() {
		$message = Messages::getAll();
		echo json_encode($message );
		// return new vue('messages')
	}

	public function postMessages() {
		
		$message["ret"] = Messages::postMessage($_POST);
		
		$message["message"] = Messages::getAll();;
		echo json_encode($message);
	}

}