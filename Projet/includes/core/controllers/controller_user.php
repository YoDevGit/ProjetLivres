<?php
    require_once "includes/core/dao/dao_user.php";
     
    switch ($action){
        case 'login' :{
            var_dump($_POST);
            require_once "includes/core/views/form_auth.phtml";
            
            if (!empty($_POST)){
                $loginSaisi = $_GET['champLogin'];
                $mdpSaisi = $_GET['champMdp'];
                
                if (userExists($loginSaisi)){
                    if (checkUser($loginSaisi, $mdpSaisi)){
                        
                    }
                    else{
                        $message = "Mauvaises informations d'identification !";
                    }
                }
                else{
                    $message = "Utilisateur inconnu";
                }
            }
            break;
        }
        // case 'list' :{
            
        //     $users = getAllUsers();
            
        //     require_once "includes/core/views/list_users.phtml";
            
        //     break;
        // }
        case 'delete' :{
            $id_user = $_GET['id'] ?? 0;
            
            if(deleteLivre($id_user)){
                $message = "Suppression confirmée";
                header('Location: ?page=user&action=list');
            }
            else{
                $message = "Erreur de suppression";
            }
            break;
        }
        default : {
            
        }
    }