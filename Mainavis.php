<?php
 try
    {
        $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery ="SELECT * FROM `avis` WHERE ValiderAvis=1;" ; 
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  
    //print_r($recipes);

    $result=$recipes;


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
        #selectstar {
            display: inline-block;
            margin-top: 8%;
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

        article p{
            margin-top: -17px;
    margin-left: 5px;
    font-size: 12px;
        }

        article h3{
            margin-top: -15px;
    color: greenyellow;
    font-weight: bold;
        }
        .big{ 
            font-size: 16px;
        }
        section{
            display: flex;
    flex-wrap: wrap;
        }

        article{
            margin-left: 15%;
        }
        #form{
            margin-left: 41%;
            display: flex;
    flex-direction: column;
        }
        #selectstar{
            margin-left: 40%;
        }
        
        input{
            width: 173px;
        }
        #form button{
            width: 173px;
    margin-left: 2px;
    margin-top: 9px;
        }
        #form textarea{
            width: 173px;
        }
    </style>
</head>
<body>
<img id="icong" src="assets/icon_garage.png" width="150px" height="50px">
    <nav>
        <a class="nav1 " href="index.html">Voiture</a>
        <a class="nav2" href="php/affiche_presta.php">Préstations</a>
        <a class="nav3 selected" href="Mainavis.php">Avis</a>
    </nav>
<section>

    <?php 
    for($i=0;$i<count($result);$i++){
        $fullstar=printnbfoiscarac($result[$i]["Noteavis"],"★");
        $cleanstar=printnbfoiscarac((5-$result[$i]["Noteavis"]),"☆");
        echo "<article>
        <h2>".$result[$i]["nomavis"]."  ".$result[$i]["prénomavis"]."</h2>
        <p>".$result[$i]["Dateavis"]."</p>
        <h3>".$fullstar.$cleanstar."</h3>
        <p class=\"big\">".$result[$i]["commentaireavis"]."</p>
        </article>
        ";
    }

        ?>
</section>

<div id="selectstar">
        <a id="star1" onmouseover="onStarHover(1)">☆</a>
        <a id="star2" onmouseover="onStarHover(2)">☆</a>
        <a id="star3" onmouseover="onStarHover(3)">☆</a>
        <a id="star4" onmouseover="onStarHover(4)">☆</a>
        <a id="star5" onmouseover="onStarHover(5)">☆</a>
    </div>

<div id="form">
    <p>Nom</p>
    <input id="nom"></input>
    <p>Prenom</p>
    <input id="prenom"></input>
    <p>Commentaire</p>
    <textarea id="commentaire"></textarea>
    <button value="Envoyer l'Avis" onclick="sendavis()">Envoyer l'Avis</button>
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
            Requete_Get("php/sendavis.php?message="+message+"&name="+name+"&surname="+surname+"&avis="+selectedStars ,printmessage)
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
            _fonc(str)
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
