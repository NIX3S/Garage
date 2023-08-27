<?php

if(isset($_GET['Agence']) && isset($_GET['mail']) && isset($_GET['Adresse']) && isset($_GET['number']) && isset($_GET['LundiAM']) && isset($_GET['MardiAM']) && isset($_GET['MercrediAM']) && isset($_GET['JeudiAM']) && isset($_GET['VendrediAM']) && isset($_GET['SamediAM']) && isset($_GET['DimancheAM']) && isset($_GET['LundiPM']) && isset($_GET['MardiPM']) && isset($_GET['MercrediPM']) && isset($_GET['JeudiPM']) && isset($_GET['VendrediPM']) && isset($_GET['SamediPM']) && isset($_GET['DimanchePM']) ){ 

                        $adresse=$_GET['Adresse'];
                        $Agence=$_GET['Agence'];
                        $mail=$_GET['mail'];
                        $number=$_GET['number'];
                        $LundiAM= $_GET['LundiAM'];
                        $MardiAM=$_GET['MardiAM'];
                        $MercrediAM=$_GET['MercrediAM'];
                        $JeudiAM=$_GET['JeudiAM'];
                        $VendrediAM=$_GET['VendrediAM'];
                        $SamediAM=$_GET['SamediAM'];
                        $DimancheAM=$_GET['DimancheAM'];
                        $LundiPM=$_GET['LundiPM'];
                        $MardiPM=$_GET['MardiPM'];
                        $MercrediPM=$_GET['MercrediPM'];
                        $JeudiPM=$_GET['JeudiPM'];
                        $VendrediPM=$_GET['VendrediPM'];
                        $SamediPM=$_GET['SamediPM'];
                        $DimanchePM=$_GET['DimanchePM'];
 try
    {
        $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery ="INSERT INTO `agence`( `NomAgence`, `Adresse`, `number`, `mail`, `LundiAM`, `LundiPM`, `MardiAM`, `MardiPM`, `MercrediAM`, `MercrediPM`, `JeudiAM`, `JeudiPM`, `VendrediAM`, `VendrediPM`, `SamediAM`, `SamediPM`, `DimancheAM`, `DimanchePM`) VALUES ('".$Agence."','".$adresse."','".$number."','".$mail."','".$LundiAM."','".$MardiAM."','".$MercrediAM."','".$JeudiAM."','".$VendrediAM."','".$SamediAM."','".$DimancheAM."','".$LundiPM."','".$MardiPM."','".$MercrediPM."','".$JeudiPM."','".$VendrediPM."','".$SamediPM."','".$DimanchePM."')"  ; 

    echo $sqlQuery;
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  
    //print_r($recipes);

    $result=$recipes;

}
?>