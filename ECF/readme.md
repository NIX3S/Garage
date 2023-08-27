Créer DB :

    CREATE DATABASE `garage`
    Créer des tables :
    Agence :
    CREATE TABLE `agence` (
    `Id` int(11) NOT NULL AUTO_INCREMENT,
    `NomAgence` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `Adresse` text COLLATE utf8_unicode_ci NOT NULL,
    `number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `mail` text COLLATE utf8_unicode_ci NOT NULL,
    `LundiAM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `LundiPM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `MardiAM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `MardiPM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `MercrediAM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `MercrediPM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `JeudiAM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `JeudiPM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `VendrediAM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `VendrediPM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `SamediAM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `SamediPM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `DimancheAM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    `DimanchePM` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`Id`)
    ) 

Avis :

    CREATE TABLE `avis` (
    `idavis` int(11) NOT NULL AUTO_INCREMENT,
    `nomavis` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `prénomavis` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `commentaireavis` text COLLATE utf8_unicode_ci NOT NULL,
    `Noteavis` int(11) NOT NULL,
    `Dateavis` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ValiderAvis` int(50) NOT NULL,
    PRIMARY KEY (`idavis`)
    ) 

Message
    CREATE TABLE `message` (
    `IDmessage` int(11) NOT NULL AUTO_INCREMENT,
    `nommessage` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `prénommessage` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `mailmessage` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `numeromessage` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `agencemessage` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `voituremessage` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `repondumessage` int(2) NOT NULL,
    `Datemessage` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `commentairemessage` text COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`IDmessage`)
    ) 

Presta :
    CREATE TABLE `presta` (
    `IDpresta` int(11) NOT NULL AUTO_INCREMENT,
    `nompresta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    `agence` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`IDpresta`)
    )

Users :
    CREATE TABLE `users` (
    `IDuser` int(11) NOT NULL AUTO_INCREMENT,
    `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
    `identifiant` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `agence` int(50) NOT NULL,
    `fonction` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`IDuser`)
    )

Voiture :
    CREATE TABLE `voiture` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `img` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `km` int(50) NOT NULL,
    `prix` double NOT NULL,
    `année` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `descript` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
    `moteur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `nbporte` int(5) NOT NULL,
    `pfiscale` decimal(10,0) NOT NULL,
    `puissance` decimal(10,0) NOT NULL,
    `consoroute` decimal(10,0) NOT NULL,
    `consoautoroute` decimal(10,0) NOT NULL,
    `consomixte` decimal(10,0) NOT NULL,
    `options` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
    `equipements` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
    `avantage` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
    `incovenient` varchar(1500) COLLATE utf8_unicode_ci NOT NULL,
    `Agence` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
    `publishdate` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    PRIMARY KEY (`ID`)
    )

Pour créer un admin faire un fichier php contenant que l’on peut appeler temp_reg.php à la racine :

    <?php

    try{
        $db = new PDO('mysql:host=localhost;dbname=Garage;charset=utf8', 'root', '');
    }
    catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
    }

    if(isset($_GET['identifiant']) && isset($_GET['password']))){
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
            $sqlQuery ="INSERT INTO `users` ( `password`, `identifiant`, `agence`, `fonction`) VALUES ( '".$hash."', '".$_GET['identifiant']."', '0', 'admin')";

            echo $sqlQuery;
            $identify=1;
                    //.$username;
            $recipesStatement = $db->prepare($sqlQuery);
            $recipesStatement->execute();
            $recipes = $recipesStatement->fetchAll();

            //print_r($recipes);
        }
    }

On mettra dans l’url :
    X =A modifier par les informations correpondantes

    X.com/temp_reg.php?identifiant=X&password=X
    Ne pas oublier de supprimer le fichier après

   Afin d’accéder au login pour les agents et admin => X.com/login.html


