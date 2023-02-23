<?php
    
    require_once "includes/core/dao/dao_livre.php";
    require_once "includes/core/dao/dao_editeur.php";
    require_once "includes/core/dao/dao_genre.php";
    require_once "includes/core/dao/dao_format.php";
    require_once "includes/core/dao/dao_langue.php";
    
    switch ($action){
        case 'list' :{
            
            $livres = getAllLivres();
            
            require_once "includes/core/views/list_livres.phtml";
            break;
        }
        case 'view' :{
            $id_livre = $_GET['id'] ?? 0;
            $livre = getLivreById($id_livre);
            
            
            require_once "includes/core/views/view_livre.phtml";
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
                    floatval ($_POST['chPrix']),
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
            
            $lesEditeurs = getAllEditeurs();
            $lesGenres = getAllGenres();
            
            //Pour construire le pattern de la liste
            // Genre
            $patternGenres ='';
            foreach ($lesGenres as $genre){
                $patternGenres .= $genre->getLibelle().'|';
            }
            $patternGenres = substr($patternGenres, 0, strlen($patternGenres) - 1);
            
            // Format
            $listeFormats = getAllFormats();
            
            $patternFormats ='';
            foreach ($listeFormats as $format){
                $patternFormats .= $format->getLibelle().'|';
            }
            $patternFormats = substr($patternFormats, 0, strlen($patternFormats) - 1);
            
            $lesLangues = getAllLangues();
            require_once "includes/core/views/form_livre.phtml";
            break;
        }
        case 'edit' :{
            $id_livre = $_GET['id'] ?? 0;
            $unLivre = getLivreById($id_livre);
            
            
            if(!empty($_POST)){
                $tmpPath = $_FILES['chCouverture']['tmp_name'];
                $destPath = 'public/medias/couvertures/';
                $destFileName = $_FILES['chCouverture']['name'];
                
                $fullDestName = $destPath.$destFileName;
                
                //si le nom de fichier n'est pas vide
                if($destFileName != ""){
                    //si le nom et le chemin du fichier sont différents du fichier d'origine
                    if($fullDestName != $unLivre->getCouverture()){
                        move_uploaded_file($tmpPath, $fullDestName);
                        $unLivre->setCouverture($fullDestName);
                    }
                }
                
                $unLivre->setTitre($_POST['chTitre']);
                $unLivre->setEditeur(getEditeurByName($_POST['chEdition']));
                $unLivre->setFormat(getFormatByName($_POST['chFormat']));
                $unLivre->setGenre(getGenreByName($_POST['chGenre']));
                $unLivre->setNbPages(intval($_POST['chNbPages']));
                $unLivre->setDateParution(date_create($_POST['chDateParution']));
                $unLivre->setLangue(getLangueById($_POST['chLangue']));
                $unLivre->setPrix(floatval ($_POST['chPrix']));
                $unLivre->setNumIsbn(intval ($_POST['chIsbn']));
                $unLivre->setResume($_POST['chResume']);
                $unLivre->setAvis($_POST['chAvis']);
                
                if(editLivre($unLivre)){
                    header('Location: ?page=livre&action=list');
                }
                else{
                    $message = "Update error";
                }
            }
            
            
            $lesEditeurs = getAllEditeurs();
            $lesGenres = getAllGenres();
            
            //Pour construire le pattern de la liste
            // Genre
            $patternGenres ='';
            foreach ($lesGenres as $genre){
                $patternGenres .= $genre->getLibelle().'|';
            }
            $patternGenres = substr($patternGenres, 0, strlen($patternGenres) - 1);
            
            // Format
            $listeFormats = getAllFormats();
            
            $patternFormats ='';
            foreach ($listeFormats as $format){
                $patternFormats .= $format->getLibelle().'|';
            }
            $patternFormats = substr($patternFormats, 0, strlen($patternFormats) - 1);
            
            $lesLangues = getAllLangues();
            require_once "includes/core/views/form_livre.phtml";
            break;
        }
        case 'delete' :{
            $id_livre = $_GET['id'] ?? 0;
            
            if(deleteLivre($id_livre)){
                $message = "Suppression confirmée";
                header('Location: ?page=livre&action=list');
            }
            else{
                $message = "Erreur de suppression";
            }
            break;
        }
    }