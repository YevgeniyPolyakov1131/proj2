<?php

class Encryption {

    private $id_administrateur = NULL;
    private $identifiant = NULL;
    private $mdp = NULL;

    const LONGUEUR_MINI_IDENTIFIANT = 8;
    const LONGUEUR_MINI_MDP = 8;
    const CYPHER = "AES-256-CBC";
    const OPENSSL_PASSWORD = "aqzsedrf123";
    const OPENSSL_VECTOR = "123abc456defg789";
    
    /**
    * Encrypte le mot de passe pour stockage dans la base de données
    */
    public static function encryptPassword($mdp = NULL) {

        return openssl_encrypt($mdp,
               self::CYPHER,
               self::OPENSSL_PASSWORD,
               NULL,
               self::OPENSSL_VECTOR);
    }

    /**
    * Décrypte le mot de passe pour son affichage
    * dans le formulaire de mise à jour d’un administrateur
    */

    public static function decryptPassword($mdp = NULL) {
        return openssl_decrypt($mdp,
               self::CYPHER,
               self::OPENSSL_PASSWORD,
               NULL,
               self::OPENSSL_VECTOR);
    }
}
?>