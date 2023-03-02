<?php

    switch ($action){
        case 'ajoutauteur' : {
            if (empty($_POST)){
                http_response_code(404);
                header('content-type: application/json; charset=utf8');
                print(json_encode(array('msgerror' => 'Parametres manquants')));
            }
            else{
                require_once "includes/core/dao/dao_auteur.php";
                // On ajoute les informations de l'auteur dans la bdd
                
                // Il faut instancier un nouvel objet Auteur
                $newAuteur = new Auteur($_POST['nomAuteur'], $_POST['prenomAuteur']);
                
                if (insertAuteur($newAuteur)){
                    http_response_code(200);
                    header('content-type: application/json; charset=utf8');
                    print(json_encode(array('id' => $newAuteur->getId(), 'nomComplet' =>$newAuteur->getPrenom().' '.$newAuteur->getNom())));
                }
                else{
                    http_response_code(500);
                    header('content-type: application/json; charset=utf8');
                    print(json_encode(array('msgerror' => 'Erreur lors de l\'enregistrement')));                    
                }
            }
            break;
        }
        
        // case 'supprauteur' : {
            
        // }
        
        case 'ajoutediteur' : {
            if (empty($_POST)){
                http_response_code(404);
                header('content-type: application/json; charset=utf8');
                print(json_encode(array('msgerror' => 'Parametres manquants'))); 
            }
            else{
                require_once "includes/core/dao/dao_editeur.php";
            
                $newEditeur = new Editeur($_POST['nom']);
            
                if (insertEditeur($newEditeur)){
                    http_response_code(200);
                    header('content-type: application/json; charset=utf8');
                    print(json_encode(array('id' => $newEditeur->getId(), 'nom' =>$newEditeur->getNom())));    
                }
                else{
                    http_response_code(500); 
                    header('content-type: application/json; charset=utf8');
                    print(json_encode(array('msgerror' => 'Erreur lors de l\'enregistrement')));    
                }
            }
            break;
        }
    
        // case 'supprediteur' : {
            
        // }
        
        case 'ajoutgenre' : {
           if (empty($_POST)){
                http_response_code(404);
                header('content-type: application/json; charset=utf8');
                print(json_encode(array('msgerror' => 'Parametres manquants'))); 
            }
            else{
                require_once "includes/core/dao/dao_genre.php";
                // On ajoute les informations du genre dans la bdd
            
                // Il faut instancier un nouvel objet Genre
                $newGenre = new Genre($_POST['libelle']);
            
                if (insertGenre($newGenre)){
                    http_response_code(200);
                    header('content-type: application/json; charset=utf8');
                    print(json_encode(array('id' => $newGenre->getId(), 'libelle' =>$newGenre->getLibelle())));
                }
                else{
                http_response_code(500); 
                header('content-type: application/json; charset=utf8');
                print(json_encode(array('msgerror' => 'Erreur lors de l\'enregistrement')));
                }
            }
            break;
        }
    
        // case 'supprgenre' : {
            
        // }
    }