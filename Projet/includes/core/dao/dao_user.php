<?php

    require_once "includes/core/config/db.php";
    
    // Vérification de l'existence de l'utilisateur
    function userExists(string $login): bool{
        $conn = getConnexion;
        
        $SQLQuery = "SELECT Count(id) as existe FROM Utilisateurs WHERE pseudo = :pseudo";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $loginTrouve = $SQLRow['existe'];
        
        $SQLStmt->closeCursor();
        return ($loginTrouve > 0);
    }
    
    // Vérification de l'association pseudo/mdp pour authentification
    function checkUser(string $pseudo, string $mdp) : bool{
        $conn = getConnexion();
        
        $SQLQuery = "SELECT Count(id) as existe FROM Utilisateurs WHERE pseudo = :pseudo AND mdp = :password";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $SQLStmt->bindValue(':password',password_hash($mdp, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $mdpStock = $SQLRow['mdp'];
        
        $SQLStmt->closeCursor();
        return (password_verify($mdp, $mdpStock));
    }
    
    // Liste des utilisateurs
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