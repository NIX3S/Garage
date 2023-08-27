<?php
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
        $sqlQuery ="SELECT id,nom,img,km,prix,année FROM voiture" ; 
        $recipesStatement = $db->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();  
        
    $sort="";
    for ($i = 0; $i < (count($recipes)); $i++) {
        $sort=$sort.$recipes[$i]["id"]."/".$recipes[$i]["nom"]."/".$recipes[$i]["prix"]."/".$recipes[$i]["année"]."/".$recipes[$i]["km"]."/[".$recipes[$i]["img"]."]/";
    }
    echo $sort;

?>
