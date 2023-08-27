<?php

if(isset($_GET['idvoiture']) && isset($_GET['name']) && isset($_GET['surname']) && isset($_GET['mail']) && isset($_GET['number']) && isset($_GET['message']) && isset($_GET['agence'])){
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    
    $sqlQuery ="INSERT INTO `message` ( `nommessage`, `prénommessage`, `mailmessage`, `numeromessage`, `agencemessage`, `voituremessage`, `repondumessage`, `commentairemessage`) VALUES ( '".$_GET['name']."', '".$_GET['surname']."', '".$_GET['mail']."', '".$_GET['number']."', '".$_GET['agence']."', '".$_GET['idvoiture']."', '0', '".$_GET['message']."');" ; 
    print($sqlQuery);
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  

    print_r($recipes);
}





?>