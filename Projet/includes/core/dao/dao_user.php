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
        
        $SQLQuery = "SELECT pseudo, password FROM Utilisateurs WHERE pseudo = :pseudo AND mdp = :password";
        
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
    
    function deleteUser(int $id_user) : bool{
        $conn = getConnexion();
        
        $SQLQuery = "DELETE FROM Choisir WHERE id_user = :id_user";
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        
            if($SQLStmt->execute()){
                
                $SQLQuery = "DELETE FROM Lus WHERE id_user = :id_user";
                $SQLStmt = $conn->prepare($SQLQuery);
                $SQLStmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
                
                    if($SQLStmt->execute()){
                        
                        $SQLQuery = "DELETE FROM Noter WHERE id_user = :id_user";
                        $SQLStmt = $conn->prepare($SQLQuery);
                        $SQLStmt->bindValue(':id_user', $id_user, PDO::PARAM_INT); 
                        
                            if($SQLStmt->execute()){
                                 
                                $SQLQuery = "DELETE FROM Favoris WHERE id_user = :id_user";
                                $SQLStmt = $conn->prepare($SQLQuery);
                                $SQLStmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
                                
                                    if($SQLStmt->execute()){
                                        
                                        $SQLQuery = "DELETE FROM Commenter WHERE id_user = :id_user";
                                        $SQLStmt = $conn->prepare($SQLQuery);
                                        $SQLStmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
                                        
                                            if($SQLStmt->execute()){
                                                
                                                $SQLQuery = "DELETE FROM genre_favoris WHERE id_user = :id_user";
                                                $SQLStmt = $conn->prepare($SQLQuery);
                                                $SQLStmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
                                                
                                                    if($SQLStmt->execute()){
                                                        
                                                        $SQLQuery = "DELETE FROM Acceder WHERE id_user = :id_user";
                                                        $SQLStmt = $conn->prepare($SQLQuery);
                                                        $SQLStmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
                                                        
                                                            if($SQLStmt->execute()){
                                                                
                                                                $SQLQuery = "DELETE FROM Utilisateurs WHERE id_user = :id_user";
                                                                $SQLStmt = $conn->prepare($SQLQuery);
                                                                $SQLStmt->bindValue(':id_user', $id_user, PDO::PARAM_INT); 
                                                                
                                                                $retVal = $SQLStmt->execute();

                                                                return $retVal; 
                                                            }
                                                            else{
                                                                return false;
                                                            }
                                                    }    
                                            }
                                    }
                             }
                    }
            }
    }