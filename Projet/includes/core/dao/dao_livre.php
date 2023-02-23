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
    
    function getLivreByName(){
        
    }
    
    function getLivreById($id_Livre){
        $conn = getConnexion();
        
        $SQLQuery = "SELECT * FROM Livre WHERE id_livre = :id_livre";
        
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindvalue(':id_livre', $id_Livre, PDO::PARAM_INT);
        $SQLStmt->execute();
        
        $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);
        $unLivre = new Livre($SQLRow['couverture'], $SQLRow['titre'], getEditeurById($SQLRow['id_editeur']), getFormatById($SQLRow['id_format']), 
                                getGenreById($SQLRow['id_genre']), $SQLRow['nbPages'], date_create($SQLRow['dateParution']), getLangueById($SQLRow['id_langue']),
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
    
    function editLivre(Livre $edit_livre) : bool{
        $conn = getConnexion();
        
        $SQLQuery = "UPDATE Livre 
                    SET couverture = :couverture, titre = :titre, id_editeur = :id_editeur, id_format = :id_format, id_genre= :id_genre, nbPages = :nbPages, dateParution = :dateParution,
                    id_langue = :id_langue, prix = :prix, numIsbn = :numIsbn, resume = :resume, avis = :avis
                    WHERE id_livre = :id_livre";
                    
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':couverture', $edit_livre->getCouverture(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':titre', $edit_livre->getTitre(), PDO::PARAM_STR);
        // $SQLStmt->bindValue(':auteur', $edit_livre->getAuteur()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':id_editeur', $edit_livre->getEditeur()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':id_format', $edit_livre->getFormat()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':id_genre', $edit_livre->getGenre()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':nbPages', $edit_livre->getNbPages(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':dateParution', $edit_livre->getDateParution()->format('Y-m-d'), PDO::PARAM_STR);
        $SQLStmt->bindValue(':id_langue', $edit_livre->getLangue()->getId(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':prix', $edit_livre->getPrix(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':numIsbn', $edit_livre->getNumIsbn(), PDO::PARAM_INT);
        $SQLStmt->bindValue(':resume', $edit_livre->getResume(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':avis', $edit_livre->getAvis(), PDO::PARAM_STR);
        $SQLStmt->bindValue(':id_livre', $edit_livre->getId(), PDO::PARAM_INT);
        return $SQLStmt->execute();
    }
    
    function deleteLivre(int $id_livre) : bool{
        $conn = getConnexion();
        
        // étapes précédentes: effacer dans toutes les tables ayant l'id_livre (+ vérif?)
        // 8 étapes : Ajouter, Appartenir, Ecrire, Lus, Noter, Favoris, A_lire, Commenter
        
        $SQLQuery = "DELETE FROM Ajouter WHERE id_livre = :id_livre";
        $SQLStmt = $conn->prepare($SQLQuery);
        $SQLStmt->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);

            if($SQLStmt->execute()){
                
                $SQLQuery = "DELETE FROM Appartenir WHERE id_livre = :id_livre";
                $SQLStmt = $conn->prepare($SQLQuery);
                $SQLStmt->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
                
                if($SQLStmt->execute()){
                    
                    $SQLQuery = "DELETE FROM Ecrire WHERE id_livre = :id_livre";
                    $SQLStmt = $conn->prepare($SQLQuery);
                    $SQLStmt->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
        
                    if($SQLStmt->execute()){
                        
                        $SQLQuery = "DELETE FROM Lus WHERE id_livre = :id_livre";
                        $SQLStmt = $conn->prepare($SQLQuery);
                        $SQLStmt->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
            
                        if($SQLStmt->execute()){
                            $SQLQuery = "DELETE FROM Noter WHERE id_livre = :id_livre";
                            $SQLStmt = $conn->prepare($SQLQuery);
                            $SQLStmt->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
                
                            if($SQLStmt->execute()){
                                 
                                $SQLQuery = "DELETE FROM Favoris WHERE id_livre = :id_livre";
                                $SQLStmt = $conn->prepare($SQLQuery);
                                $SQLStmt->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
                    
                                if($SQLStmt->execute()){
                                   
                                    $SQLQuery = "DELETE FROM A_lire WHERE id_livre = :id_livre";
                                    $SQLStmt = $conn->prepare($SQLQuery);
                                    $SQLStmt->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
                            
                                    if($SQLStmt->execute()){
                                         
                                        $SQLQuery = "DELETE FROM Commenter WHERE id_livre = :id_livre";
                                        $SQLStmt = $conn->prepare($SQLQuery);
                                        $SQLStmt->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
                            
                                        if($SQLStmt->execute()){
                                            $SQLQuery = "DELETE FROM Livre WHERE id_livre = :id_livre";
                                            $SQLStmt = $conn->prepare($SQLQuery);
                                            $SQLStmt->bindValue(':id_livre', $id_livre, PDO::PARAM_INT);
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
    }