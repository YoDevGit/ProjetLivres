<?php

    function getAllFormats(){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Format";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listeFormats = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $unFormat = new Format($SQLRow['libelle']);
            
            $unFormat->setId($SQLRow['id_format']);
            $listeFormats[] = $unFormat;
        }
        
        $SQLStmt->closeCursor();
        return $listeFormats;
    }
    
    function getFormatById($id_format){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Format WHERE id_format = :id_format";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id_format', $id_format, PDO::PARAM_INT);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unFormat = new Format($SQLRow['libelle']);
        $unFormat->setId($SQLRow['id_format']);
        
         $SQLStmt->closeCursor();
        return $unFormat;
    }
    
    function getFormatByName($libelle_format){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Format WHERE libelle = :libelle";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':libelle', $libelle_format, PDO::PARAM_STR);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unFormat = new Format($SQLRow['libelle']);
        $unFormat->setId($SQLRow['id_format']);
        
        $SQLStmt->closeCursor();
        return $unFormat;
    }
    
    function insertFormat($newFormat): bool{
        $conn = getConnexion();
        
        $SQLQuery = "INSERT INTO Format(libelle) VALUES (:libelle)";
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':libelle', $newFormat->getLibelle(), PDO::PARAM_STR);
        
        if(!$SQLStmt->execute()){
            return false;
        }
        else{
            return true;
        }
    }