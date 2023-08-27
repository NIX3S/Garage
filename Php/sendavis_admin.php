

<?php
echo "done";
if(isset($_GET['message']) && isset($_GET['name']) && isset($_GET['surname']) && isset($_GET['avis'])){
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    
    


    $sqlQuery ="INSERT INTO `avis` ( `nomavis`, `prénomavis`, `commentaireavis`, `Noteavis`, `ValiderAvis`) VALUES ( '".$_GET['name']."', '".$_GET['surname']."', '".$_GET['message']."', '".$_GET['avis']."', '1') " ; 

    print($sqlQuery);
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  

    print_r($recipes);
}