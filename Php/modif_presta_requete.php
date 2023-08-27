
<?php
if(isset($_GET['presta']) && isset($_GET['agence']) &&isset($_GET['id'])){ 
 try
    {
        $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery ="UPDATE `presta` SET `nompresta`='".$_GET['presta']."',`agence`='".$_GET['agence']."' WHERE IDpresta=".$_GET['id'] ; 
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  
    //print_r($recipes);

    $result=$recipes;

   
}
?>