ajoute_annonce_requete.php

<?php
if(isset($_GET['km']) && isset($_GET['prix']) &&isset($_GET['année']) &&isset($_GET['descript']) &&isset($_GET['moteur']) &&isset($_GET['nbporte']) &&isset($_GET['puissance']) &&isset($_GET['pfiscale']) &&isset($_GET['consoroute']) &&isset($_GET['consomixte']) &&isset($_GET['consoautoroute']) &&isset($_GET['options']) &&isset($_GET['equipements']) &&isset($_GET['nom']) &&isset($_GET['agence']) &&isset($_GET['avantage']) &&isset($_GET['incovenient']) &&isset($_GET['imgrslt'])){ 


    $km=$_GET['km'];
    $prix=$_GET['prix'];
    $année=$_GET['année'];
    $descript=$_GET['descript'];
    $moteur=$_GET['moteur'];
    $nbporte=$_GET['nbporte'];
    $puissance=$_GET['puissance'];
    $pfiscale=$_GET['pfiscale'];
    $consoroute=$_GET['consoroute'];
    $consomixte=$_GET['consomixte'];
    $consoautoroute=$_GET['consoautoroute'];
    $options=$_GET['options'];
    $equipements=$_GET['equipements'];
    $nom=$_GET['nom'];
    $agence=$_GET['agence'];
    $avantage=$_GET['avantage'];
    $incovenient=$_GET['incovenient'];
    $imgrslt=$_GET['imgrslt'];
    $id=$_GET['id'];


try
    {
        $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }


   


    $sqlQuery = "INSERT INTO `voiture`(`nom`, `img`, `km`, `prix`, `année`, `descript`, `moteur`, `nbporte`, `pfiscale`, `puissance`, `consoroute`, `consoautoroute`, `consomixte`, `options`, `equipements`, `avantage`, `incovenient`, `Agence`) VALUES ('".$nom."','".$imgrslt."','".$km."','".$prix."','".$année."','".$descript."','".$moteur."','".$nbporte."','".$pfiscale."','".$puissance."','".$consoroute."','".$consoautoroute."','".$consomixte."','".$options."','".$equipements."','".$avantage."','".$incovenient."','".$agence."')" ; 

    echo $sqlQuery;
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  
    //print_r($recipes);

    $result=$recipes;

}

?>
