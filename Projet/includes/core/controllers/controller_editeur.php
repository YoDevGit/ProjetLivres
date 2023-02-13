<?php
    require_once "includes/core/dao/dao_editeur.php";

    switch ($action){
        case 'list' : {
            
            $editeurs = getAllEditeurs();
            
            require_once "includes/core/views/list_editeurs.phtml";
            
            break;
        }
        case 'add' :{
            
            $unEditeur = new Editeur(($_POST['chNom']), ($_POST['chPrenom']));
            
            if(insertLivre($unEditeur)){
                    header('Location: ?page=editeur&action=list');
                }
                else{
                    $message = "Erreur d'enregistrement";
                }
            
            break;
        }
    }