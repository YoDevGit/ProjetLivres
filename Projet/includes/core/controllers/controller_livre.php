<?php
    
    switch ($action){
        case 'list' :{
            require_once "includes/core/models/dao_livres.php";
            
            $livres = getAllLivres();
            
            require_once "includes/core/views/list_livres.phtml";
            
            break;
        }
    }