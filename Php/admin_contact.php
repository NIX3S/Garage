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

            // Recuperer les Avis
        try
            {
                $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
            }
            catch (Exception $e)
            {
                    die('Erreur : ' . $e->getMessage());
            }
           // echo "SELECT * FROM `message` WHERE repondumessage=0 AND agencemessage=$agence";
            if($agence==0){ 
            $sqlQuery ="SELECT * FROM `message` WHERE repondumessage=0;" ; 
        }else{
            $sqlQuery ="SELECT * FROM `message` WHERE repondumessage=0 AND agencemessage=".$agence ; 
        }
            $recipesStatement = $db->prepare($sqlQuery);
            $recipesStatement->execute();
            $recipes = $recipesStatement->fetchAll();  
            //print_r($recipes);

            $result=$recipes;

            // Afficher les étoiles
            function printnbfoiscarac($nbfois,$carac){
                $retour="";
                for($i=0;$i<$nbfois;$i++){
                    $retour=$retour.$carac;
                }
                return $retour;
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
        #goback{
            position:fixed;
        }
        h1{
            text-align: center;
        }
        article{
            display:flex;
        }
        article h2 , article p , article a{
            margin-top: 26px;
            margin-left:10px;
        }
        div{ 
            margin-left:10px;
        margin-top: -35px;
    }
    input{
        margin-left: 28px;
    }
  </style>
  </head>
  <body>
<button id="goback" onclick="window.location.replace('sommaire.php')"><-</button>

<h1>Bienvenu sur la Page de gestion des Messages</h1>

<?php 
    for($i=0;$i<count($result);$i++){

        echo "<article>
        <h2>".$result[$i]["nommessage"]."  ".$result[$i]["prénommessage"]."</h2>
        <p>".$result[$i]["mailmessage"]."</p>
        <p>".$result[$i]["numeromessage"]."</p>
        <a href=\"../detail.php?id=".$result[$i]["voituremessage"]."\">Cliquer pour avoir la fiche voiture</a>
        <p>".$result[$i]["Datemessage"]."</p>
        <p>".$result[$i]["commentairemessage"]."</p>
        <div> 
        <p> Réponse Apportée </p>
        <input type=\"checkbox\" onclick=\"valider(".$result[$i]["IDmessage"].")\"> 
        </div>
        <div> 
        <p> Suppression du Message </p>
        <input type=\"checkbox\" onclick=\"supprimer(".$result[$i]["IDmessage"].")\"> 
        </div>
        </article>
        ";
    }

        ?>

<script>


function reloadingpage(){
    location.reload()
}
function valider(id){ 
    validation=confirm("Avez vous bien repondu a ce message ? ")
    if(validation==true){
        console.log("validation")
        Requete_Get("message_is_ok.php?id="+id,reloadingpage)
        
    }else{
        console.log("cancel")
    }
}

function supprimer(id){ 
    validation=confirm("Etes vous sur de supprimer ce message ? ")
    if(validation==true){
        console.log("validation")
        Requete_Get("message_is_ko.php?id="+id,reloadingpage)
    }else{
        console.log("cancel")
    }
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


            
            /*End Page Web */
        }else{
            header('Location: ../login.html');
        }
        
    }else{
        header('Location: ../login.html');
    }
}else{header('Location: ../login.html');}

?>