<?php

    require_once "includes/core/config/db.php";
    require_once "includes/core/models/Livre.php";
    require_once "includes/core/models/Auteur.php";
    require_once "includes/core/models/Editeur.php";
    require_once "includes/core/models/Format.php";
    require_once "includes/core/dao/dao_editeur.php";
    require_once "includes/core/dao/dao_format.php";
    require_once "includes/core/dao/dao_genre.php";
    require_once "includes/core/dao/dao_langue.php";
    
    function getAllLivres(): array{
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Livre";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listeLivres = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $unLivre = new Livre($SQLRow['couverture'], $SQLRow['titre'], getEditeurById($SQLRow['id_editeur']), getFormatById($SQLRow['id_format']), 
                                getGenreById($SQLRow['id_genre']), $SQLRow['nbPages'], date_create($SQLRow['dateParution']), getLangueById($SQLRow['id_langue']),
                                $SQLRow['prix'], $SQLRow['numIsbn'], $SQLRow['resume'], $SQLRow['avis']);
                    //   new Auteur($SQLRow['nom'], $SQLRow['prenom']);
            $unLivre->setId($SQLRow['id_livre']);
            
            $listeLivres[] = $unLivre;
        }
        
        $SQLStmt->closeCursor();
        return $listeLivres;
    }
    
    function getLivreById($id_Livre){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Livre WHERE id_livre = :id_livre";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id_livre', $idLivre, PDO::PARAM_INT);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unLivre = new Livre($SQLRow['couverture'], $SQLRow['titre'], getEditeurById($SQLRow['id_editeur']), getFormatById($_POST['chFormat']), 
                                getGenreById($_POST['chGenre']), $SQLRow['nbPages'], date_create($SQLRow['dateParution']), getLangueById($SQLRow['chLangue']),
                                $SQLRow['prix'], $SQLRow['numIsbn'], $SQLRow['resume'], $SQLRow['avis']);
                   
        $unLivre->setId($SQLRow['id_livre']);
        
        $SQLStmt->closeCursor();
        return $unLivre;
    }
    
    function insertLivre($newLivre): bool{
        $conn = getConnexion();
        
        $SQLQuery = "INSERT INTO Livre(couverture, titre, id_editeur, id_format, id_genre, nbPages, dateParution, id_langue, prix, numIsbn, resume, avis)
                     VALUES (:couverture, :titre, :editeur, :format, :genre, :nbPages, :dateParution, :langue, :prix, :numIsbn, :resume, :avis)";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':couverture', $newLivre->getCouverture(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':titre', $newLivre->getTitre(), PDO::PARAM_STR);
        // $SQLStmt->bindValue(':auteur', $newLivre->getAuteur()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':editeur', $newLivre->getEditeur()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':format', $newLivre->getFormat()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':genre', $newLivre->getGenre()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':nbPages', $newLivre->getNbPages(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':dateParution', $newLivre->getDateParution()->format('Y-m-d'), PDO::PARAM_STR);
        $SQLStmt->bindValue(':langue', $newLivre->getLangue()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':prix', $newLivre->getPrix(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':numIsbn', $newLivre->getNumIsbn(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':resume', $newLivre->getResume(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':avis', $newLivre->getAvis(), PDO::PARAM_STR);
        
        if(!$SQLStmt->execute()){
            return false;
        }
        else{
            return true;
        }
    }