<?php
    
     require_once "includes/core/dao/dao_livre.php";
    
    switch ($action){
        case 'list' :{
            
            $livres = getAllLivres();
            
            require_once "includes/core/views/list_livres.phtml";
            var_dump($livres);
            break;
        }
        case 'add' :{
            
            if(empty($_POST)){
                $unLivre = new Livre();
            }
            else{
                
                // récupérer le chemin temporaire du fichier uploadé
                $tmpPath = $_FILES['chCouverture']['tmp_name'];
                $destPath = 'public/medias/couvertures/';
                $destFileName = $_FILES['chCouverture']['name'];
                
                $fullDestName = $destPath.$destFileName;
                
                if (!move_uploaded_file($tmpPath, $fullDestName)){
                    die("Tu as oublié la couverture !");
                }
                
                // si l'éditeur existe déjà, il apparait dans la liste, sinon taper le nom pour ajouter.
                var_dump($_POST);                
                $unLivre = new Livre(
                    $fullDestName,
                    $_POST['chTitre'],
                    // new Auteur($_POST['chAuteur']),
                    getEditeurByName($_POST['chEdition']),
                    getFormatByName($_POST['chFormat']),
                    getGenreByName($_POST['chGenre']),
                    intval($_POST['chNbPages']),
                    date_create($_POST['chDateParution']),
                    getLangueById($_POST['chLangue']),
                    intval ($_POST['chPrix']),
                    intval ($_POST['chIsbn']),
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
            
            require_once "includes/core/dao/dao_editeur.php";
            $lesEditeurs = getAllEditeurs();
            require_once "includes/core/dao/dao_genre.php";
            $lesGenres = getAllGenres();
            
            //Pour construire le pattern de la liste
            $patternGenres ='';
            foreach ($lesGenres as $genre){
                $patternGenres .= $genre->getLibelle().'|';
            }
            $patternGenres = substr($patternGenres, 0, strlen($patternGenres) - 1);
            
            var_dump($patternGenres);
            
            require_once "includes/core/dao/dao_format.php";
            $listeFormats = getAllFormats();
            
            $patternFormats ='';
            foreach ($listeFormats as $format){
                $patternFormats .= $format->getLibelle().'|';
            }
            $patternFormats = substr($patternFormats, 0, strlen($patternFormats) - 1);
            
            require_once "includes/core/dao/dao_langue.php";
            $lesLangues = getAllLangues();
            require_once "includes/core/views/form_livre.phtml";
            break;
        }
        // case 'edit' :{
            
        // }
        case 'delete' :{
            
        }
    }