<?php
    
    function getConnexion(){
        // Etape 1 : la connexion
    	$server = 'db.3wa.io';
    	$port = '3306';
    	$dbname = 'yoantartary_CamBooks';
    	$username = 'yoantartary';
    	$password = '93fab09995e80c8efaa03a0c0ece1851';
    
    	// Construction de la chaîne de connexion : Data Source Name
    	$dsn = "mysql:host=$server;port=$port;dbname=$dbname;charset=utf8";
    
    	try{
    		$retVal = new PDO($dsn, $username, $password);
    	}catch(PDOException $ex){
    		print('Pas possible de se connecter !!!');
    		die();
    	}
    	return $retVal;
    }