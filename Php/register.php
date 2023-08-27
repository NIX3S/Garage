<?php

try{
	$db = new PDO('mysql:host=localhost;dbname=Garage;charset=utf8', 'root', '');
}
catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
}

if(isset($_GET['identifiant']) && isset($_GET['password']) && isset($_GET['agence']) && isset($_GET['fonction'])){
    $username=$_GET['identifiant'];
    $identify=0;
    $options = [
        'cost' => 12,
    ];
    
    // Verify for Username existance
    $sqlQuery ="SELECT * FROM `users` WHERE identifiant='".$_GET['identifiant']."'";
        //.$username;
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();
    //print_r($recipes);
    if(empty($recipes)){
        // Insert log into DB 
        $pass=$_GET['password'];
        $hash = password_hash($pass, PASSWORD_BCRYPT, $options);
        //echo $hash;
        $sqlQuery ="INSERT INTO `users` ( `password`, `identifiant`, `agence`, `fonction`) VALUES ( '".$hash."', '".$_GET['identifiant']."', '".$_GET['agence']."', '".$_GET['fonction']."')";

        echo $sqlQuery;
        $identify=1;
                //.$username;
        $recipesStatement = $db->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();

        //print_r($recipes);
    }
}


