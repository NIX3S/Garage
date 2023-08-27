<?php
if(isset($_COOKIE['identifiant']) && isset($_COOKIE['agence']) && isset($_COOKIE['fonction']) && isset($_COOKIE['Date']) && isset($_COOKIE['SessionID']) ){

    $identifiant=$_COOKIE['identifiant'];
    $agence=$_COOKIE['agence'];
    $fonction=$_COOKIE['fonction'];
    $time=$_COOKIE['Date'];; /* $_COOKIE['Date'];*/
    $sessionid=$_COOKIE['SessionID'];
    $text_user="";
    $text_email="";
    $text_time="";
    $Saltb="directornfeijfe876";
    $SaltA="directorlojned90";


    $difference=3600;
    $options = [
        'cost' => 12,
    ];

    for ($i=0;$i<strlen($identifiant);$i++){
        $text_user=$text_user.strval(ord($identifiant[$i]));
    };
    $text_fonction="";
    for ($i=0;$i<strlen($fonction);$i++){
        $text_fonction=$text_fonction.strval(ord($fonction[$i]));
    };
    $text_agence="";
    for ($i=0;$i<strlen($agence);$i++){
        $text_agence=$text_agence.strval(ord($agence[$i]));
    };
    $text_time="";
    for ($i=0;$i<strlen($text_time);$i++){
        $text_time=$text_time.strval(ord($text_time[$i]));
    };

    $pass=$SaltA.$text_user.$text_fonction.$text_agence.$text_time.$Saltb;
    /* difference is timestamp between now and time in cookies in sec so 60 Minutes*/
    

    $auth = password_verify($pass, $sessionid);
    //echo $auth;
    if($auth==1){
        if((time()-$difference)<=$time){
            /* Page Web */
            //echo "log on";

            if($agence==0){

                try
                {
                    $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
                }
                catch (Exception $e)
                {
                        die('Erreur : ' . $e->getMessage());
                }
                $sqlQuery ="SELECT * FROM `agence` " ; 
                $recipesStatement = $db->prepare($sqlQuery);
                $recipesStatement->execute();
                $recipes = $recipesStatement->fetchAll();  
                //print_r($recipes);
            
                $result=$recipes;
           
?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="utf-8"/>
                <meta name="description" content="ceci est la page de référence">
                <title>Notre première page</title>
                <link rel="stylesheet" href="Css/index.css"/>
                <style>
                    #goback{
            position:fixed;
        }
        h1{
            text-align:center;
        }
        div{
            display: flex;
}
.add,.supp{
    margin-left:10px;
}
.agencen{
    margin-left:42%;
}
            </style>
            </head>
            <body>
            <button id="goback" onclick="window.location.replace('sommaire.php')"><-</button>
            <h1> Mes Agences </h1>
            <button onclick='window.location.replace("ajoute_agence.php"); '>Ajouter une nouvelle Agence</button>
            <?php
            for($i=0;$i<count($recipes);$i++){
                //echo $recipes[$i]["Id"];
                echo '<div class="agencen">
                <p>'.$recipes[$i]["NomAgence"].' ('.$recipes[$i]["Id"].') </p>
                <div class="add">
                <p>Modifier</p>
                <input type="checkbox" onclick="window.location.replace(\'modification_agence.php?id='.$recipes[$i]["Id"].'\')">
                </div>
                <div class="supp">
                <p> Supprimer </p><input type="checkbox" onclick="suppression('.$recipes[$i]["Id"].')"></div></div>';
            }
            ?>

            <script>

function suppression(id){
    valider=confirm("Voulez vous vraiment supprimer l'agence ?")
    if(valider==true){
        url="supprime_agence.php?id="+id
        Requete_Get(url,reloadingpage)
    }
}

function reloadingpage(){
    location.reload()
}

function Requete_Get(url,_fonc){

var http=new XMLHttpRequest()
console.log(url)
http.open("GET",url,true);
http.onreadystatechange= function()
{
    if(http.readyState == 4 && http.status == 200){
        str=http.responseText
        _fonc()
    }
    
}
http.send(null)
}

                </script>
            </body>
            </html>

<?php

}

            /*End Page Web */
        }else{
            header('Location: ../login.html');
        }
        
    }else{
        header('Location: ../login.html');
    }
}else{header('Location: ../login.html');}

?>