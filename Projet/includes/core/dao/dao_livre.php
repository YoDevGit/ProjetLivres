<?php

    require_once "includes/core/config/db.php";
    require_once "includes/core/models/Livre.php";
    require_once "includes/core/models/Auteur.php";
    require_once "includes/core/models/Editeur.php";
    
    function getAllLivres(): array{
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Livre";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listeLivres = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $unLivre = new Livre($SQLRow['couverture'], $SQLRow['titre'], $SQLRow['nbPages'], date_create($SQLRow['dateParution']), $SQLRow['prix'], $SQLRow['resume'], $SQLRow['avis']);
                       new Auteur($SQLRow['nom'], $SQLRow['prenom']);
                       new Editeur($SQLRow['libelle']);
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
    
    function insertLivre($newLivre): bool{
        $conn = getConnexion();
        
        $SQLQuery = "INSERT INTO Livre(couverture, titre, id_auteur, id_editeur, id_format, id_genre, nbPages, dateParution, id_langue, prix, resume, avis)
                     VALUES (:couverture, :titre, :auteur, :editeur, :format, :genre, :nbPages, :dateParution, :langue, :prix, :resume, :avis)";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':couverture', $newLivre->getCouverture(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':titre', $newLivre->getTitre(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':auteur', $newLivre->getAuteur()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':editeur', $newLivre->getEditeur()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':format', $newLivre->getFormat()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':genre', $newLivre->getGenre()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':nbPages', $newLivre->getNbPages(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':dateParution', $newLivre->getDateParution()->format('Y-m-d'), PDO::PARAM_STR);
        $SQLStmt->bindValue(':langue', $newLivre->getLangue()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':prix', $newLivre->getPrix(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':resume', $newLivre->getResume(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':avis', $newLivre->getAvis(), PDO::PARAM_STR);
        
        if(!$SQLStmt->execute()){
            return false;
        }
        else{
            return true;
        }
    }