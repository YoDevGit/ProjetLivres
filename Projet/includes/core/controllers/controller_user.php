<?php
    
    switch ($action){
        case 'list' :{
            require_once "includes/core/dao/dao_user.php";
            
            $users = getAllUsers();
            
            require_once "includes/core/views/list_users.phtml";
            
            break;
        }
    }