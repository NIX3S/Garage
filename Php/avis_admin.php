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
   // echo $auth;
    if($auth==1){
        if((time()-$difference)<=$time){
            /* Page Web */

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

                #selectstar {
                    display: inline-block;
                }
                #selectstar a {
                    font-size: 30px;
                    text-decoration: none;
                    color: black;
                    margin: 5px;
                }
                #selectstar a.hovered, #selectstar a.clicked {
                    color: yellow;
                }
                div{
                    margin-left: 40%;
                }
                #infos{
                    display:flex;
                    flex-direction:column;
                }
                #nom,#prenom,#commentaire,#send{
                    height:20px;
                    width:200px;

                }
                #send{
                    margin-top:20px;
                }
            </style>
        </head>
        <body>
        <button id="goback" onclick="window.location.replace('sommaire.php')"><-</button>
        <h1> Page de création d'avis</h1>

        <div id="selectstar">
                <a id="star1" onmouseover="onStarHover(1)">☆</a>
                <a id="star2" onmouseover="onStarHover(2)">☆</a>
                <a id="star3" onmouseover="onStarHover(3)">☆</a>
                <a id="star4" onmouseover="onStarHover(4)">☆</a>
                <a id="star5" onmouseover="onStarHover(5)">☆</a>
            </div>
           
        <div id="infos">
            <p>Nom</p>
            <input id="nom"></input>
            <p>Prénom</p>
            <input id="prenom"></input>
            <p>Commentaire</p>
            <input id="commentaire"></input>
            <button id="send" onclick="sendavis()">Envois de l'avis</button>
        </div>
        <script>
            function sendavis(){
                name=document.getElementById('nom').value
                surname=document.getElementById('prenom').value
                message=document.getElementById('commentaire').value

                nameOk=0
                surnameOk=0
                messageOk=0

                if(name.search(/[0-9]/)==-1){
                    
                    if(name.indexOf("@")==-1){
                        if(name.search("[\+?{}.'\"/]")==-1){
                            nameOk=1
                        }else{
                            alert("le nom ne doit pas contenir de caractere speciale")
                        }
                    }else{
                        alert("le nom de peut inclure d' @")
                    }
                }else{
                    alert("Le nom de ne peut inclure de chiffre")
                }



                if(surname.search(/[0-9]/)==-1){
                    if(surname.indexOf("@")==-1){
                        if(surname.search("[\+?{}.'\"/]")==-1){
                            surnameOk=1
                        }else{
                            alert("le prénom ne doit pas contenir de caractere speciale")
                        }

                    }else{
                        alert("le prénom de peut inclure d' @")
                    }
                }else{
                    alert("Le prénom de ne peut inclure de chiffre")
                }

                if(message.search("[\+?{}.'\"/]")==-1){
                    messageOk=1
                }else{
                    alert("le message ne doit pas contenir de caractere speciale")
                }

                if(selectedStars!=0){
                    selectedStarsOk=1
                }else{
                    alert("Vous devez choisir une note ")
                }
                console.log(messageOk,surnameOk,nameOk,selectedStarsOk)
                if(messageOk==1 && nameOk==1 && surnameOk==1 && selectedStarsOk==1){
                    Requete_Get("sendavis_admin.php?message="+message+"&name="+name+"&surname="+surname+"&avis="+selectedStars,printmessage)
                }
            }

            function printmessage(msg){
        alert("Avis envoyé")
    }

            function Requete_Get(url,_fonc){
            var http=new XMLHttpRequest()
            console.log(url)
            http.open("GET",url,true);
            http.onreadystatechange= function()
            {
                if(http.readyState == 4 && http.status == 200){
                    str=http.responseText
                }
                
            }
            http.send(null)
            
        }

            </script>
            <script>
                let selectedStars = 0;

                function onStarHover(starNumber) {
                    const stars = document.querySelectorAll('#selectstar a');

                    for (let i = 0; i < stars.length; i++) {
                        if (i < starNumber) {
                            stars[i].classList.add('hovered');
                            stars[i].innerText="★"
                        } else {
                            stars[i].classList.remove('hovered');
                            stars[i].innerText="☆"
                        }
                    }

                    selectedStars = starNumber;
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