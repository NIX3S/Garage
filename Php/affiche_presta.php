<?php

try
    {
        $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery ="SELECT * FROM `presta`" ; 
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  
    //print_r($recipes);
    $result=$recipes;

    $sqlQuery ="SELECT * FROM `agence`" ; 
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  


    class Presta
{
    public $_prestation;
    public $_agence_id;

    function __construct($pre_prestationsta,$agence_id)
    {
        $this->_prestation = $pre_prestationsta;
        $this->_agence_id = $agence_id;
    }
    public function presta()
{
    return $this->_prestation;
}
public function agenceid()
{
    return $this->_agence_id;
}
}

class Agence
{
    public $_agence_id;
    public $_agence_nom;

    function __construct($agence_id,$agence_nom)
    {
        $this->_agence_id = $agence_id;
        $this->_agence_nom = $agence_nom;
    }
    public function agenceid()
{
    return $this->_agence_id;
}
public function agencenom()
{
    return $this->_agence_nom;
}
}
$listpresta=[];
$listagence=[];
$actualpresta=[];
$actualagence="";
    for($i=0;$i<count($result);$i++){
        //echo $result[$i]['nompresta'];
        for($a=0;$a<strlen($result[$i]['agence']);$a++){
            if($result[$i]['agence'][$a]=="/"){
                array_push($actualpresta,$actualagence);
                $actualagence="";
            }else{
                $actualagence=$actualagence.$result[$i]['agence'][$a];
            }
        }
        
        array_push($actualpresta,$actualagence);
        $actualagence="";
        $presta=new Presta($result[$i]['nompresta'],$actualpresta);
        array_push($listpresta,$presta);
        $actualpresta=[];
        $actualagence="";
    }

    for($i=0;$i<count($recipes);$i++){
        $agence=new Agence($recipes[$i]['Id'],$recipes[$i]['NomAgence']);
        array_push($listagence,$agence);
    }
    

    ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content="ceci est la page de référence">
    <title>Notre première page</title>
    <link rel="stylesheet" href="Css/index.css"/>
    <style>



h1{
    background-color: gray;
    width: 153px;
    margin-left: 43%;
}
.city{
    font-size: 24px;
    margin: 47%;

}
                .selected{
            color:red;
        }
        
        nav{
            background-color: lightgray;
    height: 50px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
        }

        .nav1{
            
            padding-left: 46px;
    margin-top: 14px;
    margin-left: 11%;
        }
        .nav2{
            margin-top: 14px;
        }
        .nav3{
            padding-right: 46px;
            margin-top: 14px;
        }
        #icong{

            position: absolute;
}
  </style>
  </head>
  <body>
  <img id="icong" src="../assets/icon_garage.png" width="150px" height="50px">
  <nav>
        <a class="nav1 " href="../index.html">Voiture</a>
        <a class="nav2 selected" href="affiche_presta.php">Préstations</a>
        <a class="nav3" href="../Mainavis.php">Avis</a>
    </nav>
  <?php
  //print_r($listpresta[0]->presta());

  
        for($i=0;$i<count($listpresta);$i++){
            $prestation= $listpresta[$i]->presta();
            $agencedepresta = $listpresta[$i]->agenceid();
            // aficher la prestation 
            echo "<div> <h1> ".$listpresta[$i]->presta()." </h1>";
            for($a=0;$a<count($agencedepresta);$a++){
                //print_r($agencedepresta[0]);
                for($b=0;$b<count($listagence);$b++){
                    if($agencedepresta[$a]==$listagence[$b]->agenceid()){
                        echo '<a class="city" href="agence_page.php?id='.$agencedepresta[$a].'"> '.$listagence[$b]->agencenom().'</a> ';      
                    }
                }


            }
            echo "</div>";
        }
  ?>

  </body>
  </html>