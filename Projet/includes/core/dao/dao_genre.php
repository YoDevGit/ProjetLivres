<?php

    function getAllGenres(){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Genre";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listeGenres = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $unGenre = new Genre($SQLRow['libelle']);
            $unGenre->setId($SQLRow['id_genre']);
            $listeGenres[] = $unGenre;
        }
        
        $SQLStmt->closeCursor();
        return $listeGenres;
    }
    
    function getGenreById($id_genre){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Genre WHERE id_genre = :id_genre";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id_genre', $id_genre, PDO::PARAM_INT);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unGenre = new Genre($SQLRow['libelle']);
        $unGenre->setId($SQLRow['id_genre']);
        
        $SQLStmt->closeCursor();
        return $unGenre;
    }
    
    function getGenreByName($libelle_genre){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Genre WHERE libelle = :libelle";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':libelle', $libelle_genre, PDO::PARAM_STR);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unGenre = new Genre($SQLRow['libelle']);
        $unGenre->setId($SQLRow['id_genre']);
        
        $SQLStmt->closeCursor();
        return $unGenre;
    }
    
    function insertGenre($newGenre): bool{
        $conn = getConnexion();
        
        $SQLQuery = "INSERT INTO Genre(libelle) VALUES (:libelle)";
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':libelle', $newGenre->getLibelle(), PDO::PARAM_STR);
        
        if(!$SQLStmt->execute()){
            return false;
        }
        else{
            return true;
        }
    }