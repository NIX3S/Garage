<?php

try{
	$db = new PDO('mysql:host=localhost;dbname=Garage;charset=utf8', 'root', '');
}
catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
}

if(isset($_GET['id']) && isset($_GET['identifiant']) && isset($_GET['password']) && isset($_GET['agence']) && isset($_GET['fonction'])){
    $username=$_GET['identifiant'];
    $identify=0;
    $options = [
        'cost' => 12,
    ];

    // Insert log into DB 
    $pass=$_GET['password'];
    $hash = password_hash($pass, PASSWORD_BCRYPT, $options);
    //echo $hash;
    $sqlQuery ="UPDATE `users` SET `password`='".$hash."',`identifiant`='".$_GET['identifiant']."',`agence`='".$_GET['agence']."',`fonction`='".$_GET['fonction']."' WHERE `IDuser`=".$_GET['id']."



        ";

    echo $sqlQuery;
    $identify=1;
            //.$username;
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();

     //print_r($recipes);
}



