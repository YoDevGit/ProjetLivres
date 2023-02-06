<?php
    
    switch ($action){
        case 'list' :{
            require_once "includes/core/dao/dao_livre.php";
            
            $livres = getAllLivres();
            
            require_once "includes/core/views/list_livres.phtml";
            
            break;
        }
        case 'add' :{
            require_once "includes/core/dao/dao_livre.php";
            
            if(empty($_POST)){
                $unLivre = new Livre();
            }
            else{
                $unLivre = new Livre(
                    $_POST['chCouverture'],
                    $_POST['chTitre'],
                    $_POST['chAuteur'],
                    $_POST['chEdition'],
                    $_POST['chNbPages'],
                    date_create($_POST['chDateParution']),
                    $_POST['chPrix'],
                    $_POST['chLangue'],
                    $_POST['chResume'],
                    $_POST['chAvis']
                );
                
                if(insertLivre($unLivre)){
                    header('Location: ?page=livre&action=list');
                }
                else{
                    $message = "Erreur d'enregistrement";
                }
            }
            
            require_once "includes/core/dao/dao_livre.php";
            $lesLivres = getAllLivres();
            require_once "includes/core/views/form_livre.phtml";
            break;
        }
    }