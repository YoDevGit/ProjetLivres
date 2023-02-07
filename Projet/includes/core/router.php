<?php

    $page = $_GET['page'] ?? 'index';
    $action = $_GET['action'] ?? 'view';
    
    switch ($page){
        case 'index' :{
            require_once("includes/core/controllers/controller.php");
            break;
        }
        case 'livre' :{
            require_once("includes/core/controllers/controller_livre.php");
            break;
        }
        case 'user' :{
            require_once("includes/core/controllers/controller_user.php");
            break;
        }
        default:{
            require_once("includes/core/controllers/controller_error.php"); // si l'on souhaite afficher une erreur 404 par exemple
        }
    }