<?php
if(isset($_GET['presta']) && isset($_GET['agence'])){ 
 try
    {
        $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery ="INSERT INTO `presta`( `nompresta`, `agence`) VALUES ('".$_GET['presta']."','".$_GET['agence']."')" ; 
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  
    //print_r($recipes);

    $result=$recipes;

   
}
?>
