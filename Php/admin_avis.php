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
            $sqlQuery ="SELECT * FROM `avis` WHERE ValiderAvis=0;" ; 
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
        .date{
            font-size: 12px;
    margin-top: -20px;
        }
        .star{
            margin-top: -15px;
        }
        .desc{
            margin-top: -14px;
        }
        section{display:flex}
        article{margin:20px}
        .moderer{
            display: flex;
    justify-content: space-around;
        }
        .moderer input{
            margin-left: 39px;
        }

  </style>
  </head>
  <body>
  <button id="goback" onclick="window.location.replace('sommaire.php')"><-</button>
<h1> Bienvenu sur la page de modération des avis</h1>

<section>
<?php 
    for($i=0;$i<count($result);$i++){
        $fullstar=printnbfoiscarac($result[$i]["Noteavis"],"★");
        $cleanstar=printnbfoiscarac((5-$result[$i]["Noteavis"]),"☆");
        echo "<article>
        <h2>".$result[$i]["nomavis"]."  ".$result[$i]["prénomavis"]."</h2>
        <p class=\"date\">".$result[$i]["Dateavis"]."</p>
        <h3 class=\"star\">".$fullstar.$cleanstar."</h3>
        <p class=\"desc\">".$result[$i]["commentaireavis"]."</p>
        <div class=\"moderer\">
        <div> 
        <p> moderation OK </p>
        <input type=\"checkbox\" onclick=\"valider(".$result[$i]["idavis"].")\"> 
        </div>
        <div> 
        <p> moderation ko </p>
        <input type=\"checkbox\" onclick=\"supprimer(".$result[$i]["idavis"].")\"> 
        </div>
        </div>
        </article>
        ";
    }

        ?>
</section>
<script>


function reloadingpage(){
    location.reload()
}
function valider(id){ 
    validation=confirm("Etes vous sur d'accepter ce commentaire ? ")
    if(validation==true){
        console.log("validation")
        Requete_Get("avis_is_ok.php?id="+id,reloadingpage)
        
    }else{
        console.log("cancel")
    }
}

function supprimer(id){ 
    validation=confirm("Etes vous sur de supprimer ce commentaire ? ")
    if(validation==true){
        console.log("validation")
        Requete_Get("avis_is_ko.php?id="+id,reloadingpage)
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