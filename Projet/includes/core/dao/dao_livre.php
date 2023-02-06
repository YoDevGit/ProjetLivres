<?php

    require_once "includes/core/config/db.php";
    require_once "includes/core/models/Livre.php";
    require_once "includes/core/models/Auteur.php";
    
    function getAllLivres(): array{
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Livre";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listeLivres = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $unLivre = new Livre($SQLRow['couverture'], $SQLRow['titre'], $SQLRow['prix']);
                       new Auteur($SQLRow['nom'], $SQLRow['prenom']);
                       new Genre($SQLRow['libelle']);
                       new Format($SQLRow['libelle']);
            $unLivre->setId($SQLRow['id']);
        }
        
        $SQLStmt->closeCursor();
        return $listeLivres;
    }
    
    function getUnLivre($idLivre){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Livre WHERE id = :id";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id', $idLivre, PDO::PARAM_INT);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unLivre = new Livre($SQLRow['couverture'], $SQLRow['titre'], $SQLRow['auteur'], $SQLRow['edition']);
        $unLivre->setId($SQLRow['id']);
        
        $SQLStmt->closeCursor();
        return $unLivre;
    }