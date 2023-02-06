<?php

    require_once "includes/core/models/db.php";
    require_once "includes/core/models/Auteur.php";
    
    // Fonction qui exécute le SELECT ... FROM civilite et renvoie le résultat sous la forme attendue
    function gatAllCiv(): array{
        $conn = getConnection();
        
        $SQLQuery = "SELECT * FROM civilite";
        
        $SQSLStmt = $conn->prepare($SQLQuery);
        $SQSLStmt->execute();
        
        $listeCivilites = array();
        
        while ($SQLRow = $SQSLStmt->fetch(PDO::FETCH_ASSOC)){
            $uneCivilite = new Civilite($SQLRow['libelle']);
            
            $uneCivilite->setId($SQLRow['id']);
            
            $listeCivilites[] = $uneCivilite;
        }
        
        $SQLStmt->closeCursor();
        return $listeCivilites;
    }
    
    function getCiviliteById(int $id): Civilite{
        $conn = getConnection();
        
        $SQLQuery = "SELECT id, libelle 
                     FROM civilite
                     WHERE id = :id";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id', $id, PDO::PARAM_INT);
        $SQLStmt->execute;
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $uneCivilite = new Civilite($SQLRow['libelle']);
        $uneCivilite->setId($SQLRow['id']);
        
        $SQLStmt->closeCursor();
        return $uneCivilite;
    }