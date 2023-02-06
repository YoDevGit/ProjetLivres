<?php

    require_once "includes/core/config/db.php";
    
    function getAllUsers(): array{
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Utilisateurs";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listeUsers = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $user = new User($SQLRow['pseudo'], $SQLRow['mail']);
            $user->setId($SQLRow['id']);
            $listeUsers[] = $user;
        }
        $SQLStmt->closeCursor();
        return $listeUsers;
    }
    
    function getUserById(int $id): User{
        $conn = getConnection();
        
        $SQLQuery = "SELECT * FROM Utilisateurs WHERE id = :id";
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id', $id, PDO::PARAM_INT);
        $SQLStmt->execute;
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $user = new User($SQLRow['pseudo'], $SQLRow['mail']);
        $user->setId($SQLRow['id']);
        
        $SQLStmt->closeCursor();
        return $user;
    }