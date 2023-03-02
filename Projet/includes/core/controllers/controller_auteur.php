<?php
    require_once "includes/core/dao/dao_auteur.php";
    
    switch ($action){
        case 'list' : {
            
            $auteurs = getAllAuteurs();
            
            require_once "includes/core/views/list_auteurs.phtml";
        }
        case 'add' : {
            
            $unAuteur = new Auteur(htmlentities($_POST['chNom']), htmlentities($_POST['chPrenom']));
            
            if(insertLivre($unAuteur)){
                    header('Location: ?page=auteur&action=list');
                }
                else{
                    $message = "Erreur d'enregistrement";
                }
            break;
        }
    }