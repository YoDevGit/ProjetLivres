<?php

    require_once "includes/core/config/db.php";
    require_once "includes/core/models/Auteur.php";
    
    function getAllAuteurs(){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Auteur";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listeAuteurs = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $unAuteur = new Auteur($SQLRow['nom'], $SQLRow['prenom']);
            
            $unAuteur->setId($SQLRow['id_auteur']);
            $listeAuteurs[] = $unAuteur;
        }
        
        $SQLStmt->closeCursor();
        return $listeAuteurs;
    }
    
    function getUnAuteur($id_auteur){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Auteur WHERE id_auteur = :id";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id', $id_auteur, PDO::PARAM_INT);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unAuteur = new Auteur($SQLRow['nom'], $SQLRow['prenom']);
        $unAuteur->setId($SQLRow['id_auteur']);
        
        $SQLStmt->closeCursor();
        return $unAuteur;
    }
    
    function insertAuteur($newAuteur): bool{
        $conn = getConnexion();
        
        $SQLQuery = "INSERT INTO Auteur(nom, prenom) VALUES (:nom, :prenom)";
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':nom', $newAuteur->getNom(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':prenom', $newAuteur->getPrenom(), PDO::PARAM_STR);
        
        if(!$SQLStmt->execute()){
            return false;
        }
        else{
            return true;
        }
    }
    
    function getAuteurByLivreId($id_livre){
        $conn = getConnexion();
        
        //Je récupère l'id_auteur lié à l'id_livre dans la relation Ecrire
        $SQLQuery = "SELECT id_auteur FROM Ecrire WHERE id_livre = :id_livre";
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id_livre', $id_livre, PDO::PARAM_INT);
        $SQLStmt->execute();
        
        $listId = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        
        $SQLStmt->closeCursor();
        
        $listId = array();
        
        foreach($listId as $auteur_id){
            $unAuteur = getUnAuteur($id_auteur);
            $lesAuteurs[] = $unAuteur;
            return $lesAuteurs;
        }
    }
    