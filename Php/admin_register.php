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
                $sqlQuery ="SELECT * FROM agence INNER JOIN users ON agence.Id = users.agence" ; 
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
                    #add_user_schema{
                        display:flex;
                        margin-left: 22%;
                    }
                    #add_user_schema p{
                        margin: 4%;
                    }
                    #add_user{
                        display:flex;
                        margin-top:-2%;
                        margin-bottom:4%;
                        margin-left:20%;
                    }
                    .users{
                        display:flex;
                        margin-left:20%;
                        margin-top:10px;
                        
                    }
                    .users div input{
                        margin-left: 30%;
                    }
                    .users div{
                        margin-left: 10px;
                        margin-top:-15px;
                    }
                    h1{
                        text-align:center;
                    }
                    #goback{
            position:fixed;
        }
            </style>
            </head>
            <body>
            <button id="goback" onclick="window.location.replace('sommaire.php')"><-</button>
            <h1> Liste des utilisateurs </h1>

            <div id="add_user_schema">
                <p>identifiant</p>
                <p>password</p>
                <p></p>
                <p>Agence</p>
                <p>Fonction</p>
            </div>

            <div id="add_user">
                <input id="identifiant">
                <input id="password">
                <p>Agence </p>
                <input id="agence" >
                <input id="fonction">
                <input type="button" value="New User" onclick="adduser()">
            </div>
            

            <?php
            for($i;$i<count($result);$i++){
                echo '
                <div class="users">
                <input id="identifiant'.$result[$i]["IDuser"].'" value="'.$result[$i]["identifiant"].'">
                <input id="password'.$result[$i]["IDuser"].'" value="'.$result[$i]["password"].'">
                <p>Agence </p>
                <input id="agence'.$result[$i]["IDuser"].'" value="'.$result[$i]["agence"].'">
                <p> '.$result[$i]["NomAgence"].'</p>
                <input id="fonction'.$result[$i]["IDuser"].'" value="'.$result[$i]["fonction"].'"></input>
                <div>
                <p> Modifier l\'utilisateur</p>
                <input type="checkbox" onclick="modif('.$result[$i]["IDuser"].')"></input>
                </div>
                <div>
                <p> Supprimer l\'utilisateur</p>
                <input type="checkbox" onclick="supprimer('.$result[$i]["IDuser"].')"></input>
                </div>
            </div>
            
            ';
            }
            
            
            ?>


<script>

function adduser(){
    let identifiant = document.getElementById('identifiant').value
    let password = document.getElementById('password').value
    let agence = document.getElementById('agence').value
    let fonction =  document.getElementById('fonction').value

    if(agence==0){
        validation=confirm("Cet utilisateur doit bien être admin ? ")
        if(validation==true){
            Requete_Get("register.php?identifiant="+identifiant+"&password="+password+"&agence="+agence+"&fonction="+fonction,reloadingpage)
        }
    }else{
        Requete_Get("register.php?identifiant="+identifiant+"&password="+password+"&agence="+agence+"&fonction="+fonction,reloadingpage)
    }
    
}

function reloadingpage(){
    location.reload()
}


function modif(id){ 
    let identifiant=document.getElementById('identifiant'+id).value
    let password=document.getElementById('password'+id).value
    let fonction=document.getElementById('fonction'+id).value
    let agence=document.getElementById('agence'+id).value
    validation=confirm("Voulez vous vraiment modifier l'utilisateur ? ")
    if(validation==true){
        console.log("validation")
        console.log("modif_user.php?id="+id+"&identifiant="+identifiant+"&password="+password+"&fonction="+fonction+"&agence="+agence)
        Requete_Get("modif_user.php?id="+id+"&identifiant="+identifiant+"&password="+password+"&fonction="+fonction+"&agence="+agence,reloadingpage)
        
    }else{
        console.log("cancel")
    }
}

function supprimer(id){ 
    validation=confirm("Etes vous sur de supprimer cet utilisateur ? ")
    if(validation==true){
        console.log("validation")
        Requete_Get("delete_user.php?id="+id,reloadingpage)
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
        }

        }else{
            header('Location: ../login.html');
        }
        
    }else{
        header('Location: ../login.html');
    }
}else{header('Location: ../login.html');}

?>