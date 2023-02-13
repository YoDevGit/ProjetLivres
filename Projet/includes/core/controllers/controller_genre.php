<?php
    require_once "includes/core/dao/dao_genre.php";
    
    switch ($action){
        case 'list' : {
            
            $genres = getAllGenres();
            
            require_once "includes/core/views/list_genres.phtml";
            
            break;
        }
        case 'add' : {
            
             if(empty($_POST)){
                $unGenre = new Genre();
            }
            else{
                $unGenre = new Genre(($_POST['chGenre']));
            
            if(insertLivre($unGenre)){
                    header('Location: ?page=genre&action=list');
                }
                else{
                    $message = "Erreur d'enregistrement";
                }
            }
            
            break;
        }
    }