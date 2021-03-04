<?php

class Favoris extends Model {



    public static function getFavori($id){
        
        return Favoris::where('annonce_id','=',$id)->where('usager_id','=',$_SESSION['usager_id']);
        
    }

    public static function deleteFavori($annonce, $usager){

          /**
     * Supprimant d'un item dans une table
     *
	 * @return boolean false si item n'a été supprimé dans la table principale, true sinon
     */

        $sPDO = SingletonPDO::getInstance();
        $req = "DELETE FROM favoris WHERE usager_id = $usager AND annonce_id = :annonce ";
        $oPDOStatement = $sPDO->prepare($req);
        $oPDOStatement->bindValue(':annonce',$annonce); 
        $oPDOStatement->execute();
        if ($oPDOStatement->rowCount() == 0) {
			return false;
        } else {
			return true;
        }
        
 

    }




    public static function getAllFavoris($table,$usager) {
        $tabName = strtolower(get_called_class());
        $className = get_called_class();

        $sPDO = SingletonPDO::getInstance(); 
		$oPDOStatement = $sPDO->prepare("SELECT *, annonces.usager_id as annoncesUsager_id, annonces.annonce_id as annoncesAnnonce_id, favoris.usager_id as favorisUsager_id, favoris.annonce_id as favorisAnnonce_id  FROM $tabName JOIN annonces ON annonces.annonce_id = favoris.annonce_id JOIN villes ON villes.ville_id = annonces.ville_id JOIN images ON images.image_id = annonces.image_id WHERE favoris.usager_id = $usager ORDER BY favoris.favori_id ASC"); 
        $oPDOStatement->execute();

        $elmsClass = new Collection; $ind = 0;
        foreach($oPDOStatement->fetchAll(PDO::FETCH_ASSOC) as $data){

            $elmClass = new $className($data);
            $elmsClass->{$ind}=$elmClass; $ind++;
            
        }

        return $elmsClass;
    }







        /**
     * Récupération des lignes d'une table 
     *
	 * @return array
     */
    public static function getfavoris($table,$usager) {
        $sPDO = SingletonPDO::getInstance();
		$oPDOStatement = $sPDO->prepare("SELECT COUNT(favoris.usager_id) as nbFavoris FROM $table JOIN annonces ON annonces.annonce_id = favoris.annonce_id WHERE favoris.usager_id = $usager ORDER BY favoris.usager_id DESC"); 
        $oPDOStatement->execute();
        return $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
    }




          /**
     * Ajout d'un item dans une table
     *
	 * @return boolean false if no row added in the main table, true otherwise
     */
    public static function postFavoris($table, $champs) {
        

        $sPDO = SingletonPDO::getInstance();
        $req = "INSERT INTO $table SET ";
        foreach ($champs as $nom => $valeur) {
			$req .= $nom."=:".$nom.", "; 
        }
        $req = substr($req, 0, -2);
        $oPDOStatement = $sPDO->prepare($req);
        foreach ($champs as $nom => $valeur) {
			$oPDOStatement->bindValue(":".$nom, $valeur);
        }
        $oPDOStatement->execute();
        if ($oPDOStatement->rowCount() == 0) {
			return false;
        } else {
			return true;
        }
    }


           /**
     * Récupération des lignes d'une table 
     *
	 * @return array
     */
    public static function getfavorisAll($table,$usager) {
        $sPDO = SingletonPDO::getInstance();
		$oPDOStatement = $sPDO->prepare("SELECT *, annonces.usager_id as annoncesUsager_id, annonces.annonce_id as annoncesAnnonce_id, favoris.usager_id as favorisUsager_id, favoris.annonce_id as favorisAnnonce_id  FROM $table JOIN annonces ON annonces.annonce_id = favoris.annonce_id WHERE favoris.usager_id = $usager ORDER BY favoris.usager_id DESC"); 
        $oPDOStatement->execute();
        return $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
    }



}

?>