<?php

    require_once "includes/core/config/db.php";
    
    function getAllUsers(): array{
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Utilisateurs";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->execute();
        
        $listUsers = array();
        
        while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)){
            $user = new User($SQLRow['pseudo'], $SQLRow['mail']);
            $user->setId($SQLRow['id']);
            $listUsers[] = $user;
        }
        $SQLStmt->closeCursor();
        return $listUsers;
    }
    
    // function getUserById(int $id): User{
    //     $conn = getConnection();
        
    //     $SQLQuery = "SELECT * FROM Utilisateurs WHERE id = :id";
    //     $SQLStmt = $conn->prepare($SQLQuery);
    //     $SQLStmt->bindvalue(':id', $id, PDO::PARAM_INT);
    //     $SQLStmt->execute;
        
    //     $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
    //     $user = new User($SQLRow['pseudo'], $SQLRow['mail']);
    //     $user->setId($SQLRow['id']);
        
    //     $SQLStmt->closeCursor();
    //     return $user;
    // }