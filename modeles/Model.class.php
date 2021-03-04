<?php

/**
 * Classe Model, accès PDO aux tables MySQL
 *
 */

abstract class Model {

    protected $table;
    protected static $primaryKey;
    protected $fillAttributes = array();
    protected static $joins;
    protected static $groupBy;
    protected static $orderBy;

    public function __construct($attributes = null){

        if($attributes !== null){

            foreach ($attributes as $key => $value) {
                $this->addProperty($key, $value);
            }
        }

        $this->table = get_class($this);
        $this::$primaryKey = strtolower(substr(get_called_class(),0,-1))."_id";        

    }

    private function addProperty($key, $value){

        $this->{$key} = $value;


    }

    public static function join($tab_str,$direction){
        
        $tabName = strtolower(get_called_class());
        $className = get_called_class();

        $tables = explode(',',$tab_str); 
        
        if($direction == 'many'){

            if(count($tables) >= 2){

                $elmClass = new $className;
                $elmClass::$joins .= " JOIN ". $tables[0] . " ON ".$tables[0].".".$elmClass::$primaryKey." = ".$tabName.".".$elmClass::$primaryKey;

                for($i = 1; $i < count($tables); $i++){
                    $bdClassName = ucfirst($tables[$i]);
                    $bd = new $bdClassName;
                    $foreignKey = $bd::$primaryKey;

                    $elmClass::$joins .= " JOIN ". $tables[$i] . " ON ".$tables[0].".".$foreignKey." = ".$tables[$i].".".$foreignKey;
                }


            }

        }else 
        if($direction == 'with'){

            if(count($tables) >= 2){

                $keys = [];
                for($i = 1; $i < count($tables); $i++){
                    $bdClassName = ucfirst($tables[$i]);
                    $bd = new $bdClassName;
                    $keys[$i] = $bd::$primaryKey;
                }                

                $elmClass = new $className;
                
                for($i = 1; $i < count($tables); $i++){
                
                    $elmClass::$joins .= " JOIN ". $tables[$i] . " ON ".$tables[0].".".$keys[$i]." = ".$tables[$i].".".$keys[$i];

                }

            }

        }else{

            if(count($tables) == 1){

                $bdClassName = ucfirst($tables[0]);
                $bd = new $bdClassName;
                $foreignKey = $bd::$primaryKey;

                $elmClass = new $className;
                if($direction == "from"){

                    $elmClass::$joins .= " JOIN ". $tables[0] . " ON ".$tables[0].".".$elmClass::$primaryKey." = ".$tabName.".".$elmClass::$primaryKey;

                }else{

                    $elmClass::$joins .= " JOIN ". $tables[0] . " ON ".$tables[0].".".$foreignKey." = ".$tabName.".".$foreignKey;

                }

            }
            if(count($tables) == 2){

                
            }            

        }      
        
        
        return $elmClass;

    }

    public static function groupBy($field){
        
        $tabName = get_called_class();
        $elmClass = new $tabName;
        $elmClass::$groupBy = " GROUP BY ".$field." ";
        
        return $elmClass;

    }    

    public static function orderBy($field, $order){
        
        $tabName = get_called_class();
        $elmClass = new $tabName;
        $elmClass::$orderBy = " ORDER BY ".$field." ".$order." ";
        
        return $elmClass;

    }      

     /**
     * Récupération des lignes d'une table 
     *
	 * @return Collection d'un enfant ou enfants de classe 'Model'
     */
    public static function getAll() {
        $tabName = strtolower(get_called_class()); 

        $sPDO = SingletonPDO::getInstance();
		$oPDOStatement = $sPDO->prepare("SELECT * FROM $tabName ".self::$joins.self::$groupBy.self::$orderBy);
        $oPDOStatement->execute(); 

        self::$joins = ""; self::$groupBy = ""; self::$orderBy = "";

        $elmsClass = new Collection; $ind = 0;
        foreach($oPDOStatement->fetchAll(PDO::FETCH_ASSOC) as $data){

            $elmClass = new $tabName($data);
            $elmsClass->{$ind}=$elmClass; $ind++;
            
        }

        return $elmsClass;
    }


    /**
     * Récupération d'un item 
     *
	 * @return un enfant de classe 'Model'
     */
    public static function getItem($id) {
        $tabName = strtolower(get_called_class());
        $className = get_called_class();
        $class_courant = new $className;
        $sPDO = SingletonPDO::getInstance(); 
        $oPDOStatement = $sPDO->prepare("SELECT * FROM $tabName ".self::$joins." WHERE $tabName".".".$class_courant::$primaryKey."=:id"); 
        $oPDOStatement->bindValue(':id', $id);
        $oPDOStatement->execute(); 

        self::$joins = "";

        $data = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
        if($data){
            $elmClass = new $className($data);
            return $elmClass;
            
        } else {

            return false;
        }

    }    

   
    /**
     * Ajout d'un item dans une table
     *
	 * @return boolean false si item n'a été ajouté dans la table principale, true sinon
     */
    public static function postItem($elmClass) { 
        try{
            $tabName = strtolower(get_called_class());

            $sPDO = SingletonPDO::getInstance();
            $req = "INSERT INTO $tabName SET ";

            foreach($elmClass as $key => $value){
                if(in_array($key, $elmClass->fillAttributes)){

                    $req .= $key."=:".$key.", ";

                }
            }

            $req = substr($req, 0, -2); 

            $oPDOStatement = $sPDO->prepare($req);

            foreach($elmClass as $key => $value){
                if(in_array($key, $elmClass->fillAttributes)){

                    $oPDOStatement->bindValue(":".$key, $value);

                }
            }        
            
            $oPDOStatement->execute(); 
            if ($oPDOStatement->rowCount() == 0) {
                return false;
            } else {
                return $sPDO->lastInsertId();
            }


        }catch(\Throwable $th){

            echo "<h4>Ajouter des noms de champ à propriété fillAttributes dans le modèle $tabName pour bien fonctionné method postItem </h4>";

        }

           
    }
    
    /**
     * Modification d'un item dans une table
     *
	 * @return boolean false si item n'a été modifié dans la table principale, true sinon
     */
    public static function putItem($elmClass, $elmClassId = null) {
        try{        
            $tabName = strtolower(get_called_class());

            $sPDO = SingletonPDO::getInstance();
            $req = "UPDATE $tabName SET ";

            foreach($elmClass as $key => $value){
                if(in_array($key, $elmClass->fillAttributes)){

                    $req .= $key."=:".$key.", "; 

                }
            }

            $req  = substr($req, 0, -2); 
            if($elmClassId == null)
            $req .= " WHERE ".self::$primaryKey."=".$elmClass->{self::$primaryKey}; 
    else    $req .= " WHERE ".self::$primaryKey."=".$elmClassId->{self::$primaryKey};
            $oPDOStatement = $sPDO->prepare($req); 

            foreach($elmClass as $key => $value){
                if(in_array($key, $elmClass->fillAttributes)){

                    $oPDOStatement->bindValue(":".$key, $value);

                }
            } 

            $oPDOStatement->execute();
            if ($oPDOStatement->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        }catch(\Throwable $th){

            echo "<h4>Ajouter des noms de champ à propriété fillAttributes dans le modèle $tabName pour bien fonctionné method putItem </h4>";

        }        
    }   
    
    /**
     * Supprimant d'un item dans une table
     *
	 * @return boolean false si item n'a été supprimé dans la table principale, true sinon
     */
    public static function deleteItem($elmClass) {
        $tabName = strtolower(get_called_class());

        $sPDO = SingletonPDO::getInstance();
        $req = "DELETE FROM $tabName WHERE ".self::$primaryKey."=".$elmClass->{self::$primaryKey};
        $oPDOStatement = $sPDO->prepare($req);
        $oPDOStatement->execute();
        if ($oPDOStatement->rowCount() == 0) {
			return false;
        } else {
			return true;
        }
        
    } 


    /**
     * Recherche d'un ou plusieur items dans une table
     *
	 * @return Collection d'un enfant ou enfants de classe 'Model'
     */
    public static function where($field,$sign,$value) {
        $tabName = strtolower(get_called_class());
        $className = get_called_class();

        $sPDO = SingletonPDO::getInstance();
        $oPDOStatement = $sPDO->prepare("SELECT * FROM $tabName " .self::$joins. " WHERE $field $sign:val ". self::$groupBy.self::$orderBy );
        $oPDOStatement->bindValue(':val',$value);        
        $oPDOStatement->execute();

        self::$joins = ""; self::$groupBy = ""; self::$orderBy = "";

        $elmsClass = new Collection; $ind = 0;
        foreach($oPDOStatement->fetchAll(PDO::FETCH_ASSOC) as $data){

            $elmClass = new $className($data);
            $elmsClass->{$ind}=$elmClass; $ind++;
            
        }

        return $elmsClass;       
        
    }

 

}