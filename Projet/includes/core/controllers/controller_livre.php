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
                
                // récupérer le chemin temporaire du fichier uploadé
                $tmpPath = $_FILES['chCouverture']['tmp_name'];
                $destPath = 'public/medias/couvertures';
                $destFileName = $_FILES['chCouverture']['name'];
                
                $fullDestName = $destPath.$destFileName;
                
                if (!move_uploaded_file($tmpPath, $fullDestName)){
                    die("Erreur Upload");
                }
                
                var_dump ($_FILES);
                $unLivre = new Livre(
                    $fullDestName,
                    $_POST['chTitre'],
                    new Auteur($_POST['chAuteur']),
                    new Editeur($_POST['chEdition']),
                    new Format($_POST['chFormat']),
                    new Genre($_POST['chGenre']),
                    $_POST['chNbPages'],
                    date_create($_POST['chDateParution']),
                    new Langue($_POST['chLangue']),
                    $_POST['chPrix'],
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
            
            // require_once "includes/core/dao/dao_langue.php";
            // $lesLangues = getAllLangues();
            require_once "includes/core/dao/dao_livre.php";
            $lesLivres = getAllLivres();
            require_once "includes/core/views/form_livre.phtml";
            break;
        }
        // case 'edit' :{
            
        // }
        // case 'delete' :{
            
        // }
    }