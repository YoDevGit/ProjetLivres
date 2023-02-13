<?php

    function getAllLangues(){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Langue";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listeLangues = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $uneLangue = new Langue($SQLRow['libelle']);
            
            $uneLangue->setId($SQLRow['id_langue']);
            $listeLangues[] = $uneLangue;
        }
        
        $SQLStmt->closeCursor();
        return $listeLangues;
    }
    
    function getLangueById($id_langue){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Langue WHERE id_langue = :id_langue";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id_langue', $id_langue, PDO::PARAM_INT);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $uneLangue = new Langue('libelle');
        $uneLangue->setId($SQLRow['id_langue']);
        
         $SQLStmt->closeCursor();
        return $uneLangue;
    }
    
    function getLangueByName($libelle_langue){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Langue WHERE libelle = :libelle";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':libelle', $libelle_langue, PDO::PARAM_STR);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $uneLangue = new Langue($SQLRow['libelle']);
        $uneLangue->setId($SQLRow['id_langue']);
        
        $SQLStmt->closeCursor();
        return $uneLangue;
    }
    
    function insertLangue($newLangue): bool{
        $conn = getConnexion();
        
        $SQLQuery = "INSERT INTO Langue(libelle) VALUES (:libelle)";
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':libelle', $newLangue->getLibelle(), PDO::PARAM_STR);
        
        if(!$SQLStmt->execute()){
            return false;
        }
        else{
            return true;
        }
    }
