<?php

    function getAllEditeurs(){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Editeur";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listeEditeurs = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $unEditeur = new Editeur($SQLRow['nom']);
            
            $unEditeur->setId($SQLRow['id_editeur']);
            $listeEditeurs[] = $unEditeur;
        }
        
        $SQLStmt->closeCursor();
        return $listeEditeurs;
    }
    
    function getEditeurById($id_editeur){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Editeur WHERE id_editeur = :id_editeur";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id_editeur', $id_editeur, PDO::PARAM_INT);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unEditeur = new Editeur($SQLRow['nom']);
        $unEditeur->setId($SQLRow['id_editeur']);
        
        $SQLStmt->closeCursor();
        return $unEditeur;
    }
    
    function getEditeurByName($nom_editeur){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Editeur WHERE nom = :nom";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':nom', $nom_editeur, PDO::PARAM_STR);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unEditeur = new Editeur($SQLRow['nom']);
        $unEditeur->setId($SQLRow['id_editeur']);
        
        $SQLStmt->closeCursor();
        return $unEditeur;
    }
    
    function insertEditeur($newEditeur): bool{
        $conn = getConnexion();
        
        $SQLQuery = "INSERT INTO Editeur(nom) VALUES (:nom)";
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':nom', $newEditeur->getNom(), PDO::PARAM_STR);
        
        if(!$SQLStmt->execute()){
            return false;
        }
        else{
            return true;
        }
    }
    
    