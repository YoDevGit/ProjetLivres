<?php

//index.php?page=test&action=test

    require_once "includes/core/dao/dao_auteur.php";
    require_once "includes/core/dao/dao_livre.php";
     require_once "includes/core/dao/dao_editeur.php";
    
    switch ($action){
        case 'test' : {
            var_dump(getAuteurByLivreId(1));
            // var_dump(getUnLivre(1));
        }
    }