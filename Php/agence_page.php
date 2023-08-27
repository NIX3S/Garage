<?php
if(isset($_GET["id"])){
     //print 'Isdei=fine';
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
            die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery ="SELECT * FROM agence Where Id=".$_GET["id"] ; 
    $recipesStatement = $db->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();  
     //print_r($recipes);

    $NomAgence=$recipes[0]["NomAgence"];
    $Adresse=$recipes[0]["Adresse"];
    $number=$recipes[0]["number"];
    $mail=$recipes[0]["mail"];
    $LundiAM=$recipes[0]["LundiAM"];	
    $LundiPM=$recipes[0]["LundiPM"];	
    $MardiAM=$recipes[0]["MardiAM"];
    $MardiPM=$recipes[0]["MardiPM"];
    $MercrediAM=$recipes[0]["MercrediAM"];
    $MercrediPM=$recipes[0]["MercrediPM"];
    $JeudiAM=$recipes[0]["JeudiAM"];
    $JeudiPM=$recipes[0]["JeudiPM"];
    $VendrediAM=$recipes[0]["VendrediAM"];
    $VendrediPM=$recipes[0]["VendrediPM"];
    $SamediAM=$recipes[0]["SamediAM"];
    $SamediPM=$recipes[0]["SamediPM"];
    $DimancheAM=$recipes[0]["DimancheAM"];
    $DimanchePM=$recipes[0]["DimanchePM"];


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
        h1{
            text-align:center;
        }
        table{
            text-align:center;
            margin:auto;
        }
        td{
            padding:5px;
        }
        #form{
            display:flex;
            flex-direction:column;
            margin-left:44%;
        }
        #nom,#prénom,#mail,#numéro,#message,#submit{
            width:200px;

        }
        #submit{
            margin-top:5px;
        }
        </style>
<head>
<body>
<img id="icong" src="../assets/icon_garage.png" width="150px" height="50px">
<nav>
        <a class="nav1 " href="../index.html">Voiture</a>
        <a class="nav2 selected" href="affiche_presta.php">Préstations</a>
        <a class="nav3" href="../Mainavis.php">Avis</a>
    </nav>

    <h1><?php print $NomAgence; ?></h1>

<section>
    <p>Adresse : <?php print $Adresse; ?> </p>
    <a href="mailto:<?php print $mail; ?>?subject=information"> Mail : <?php print $mail; ?> </a>
    </br>
    </br>
    <a id="atel" href="tel:<?php print $number; ?>" >N° : <?php print $number; ?> </a>
    <table>
    <thead>
        <tr>
            <th colspan="8">Heures d'ouverture</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tranche Horaire</td>
            <td>Lundi</td>
            <td>Mardi</td>
            <td>Mercredi</td>
            <td>Jeudi</td>
            <td>Vendredi</td>
            <td>Samedi</td>
            <td>Dimanche</td>
        </tr>
        <tr>
            <td>Matin</td>
            <td><?php print $LundiAM; ?></td>
            <td><?php print $MardiAM; ?></td>
            <td><?php print $MercrediAM; ?></td>
            <td><?php print $JeudiAM; ?></td>
            <td><?php print $VendrediAM; ?></td>
            <td><?php print $SamediAM; ?></td>
            <td><?php print $DimancheAM; ?></td>
        </tr> 
        <tr>
            <td>Aprés-Midi</td>
            <td><?php print $LundiPM; ?></td>
            <td><?php print $MardiPM; ?></td>
            <td><?php print $MercrediPM; ?></td>
            <td><?php print $JeudiPM; ?></td>
            <td><?php print $VendrediPM; ?></td>
            <td><?php print $SamediPM; ?></td>
            <td><?php print $DimanchePM; ?></td>
        </tr>
    </tbody>
</table>


    </section>
    <article id="form">
    <h2>Envoyer un message</h2>
    <p>nom</p>
    <input id="nom">
    <p>prénom</p>
    <input id="prénom">
    <p>mail</p>
    <input id="mail">
    <p>numéro</p>
    <input id="numéro">
    <p>message</p>
    <textarea id="message"
          rows="3" cols="33">

</textarea>
<button id="submit" type="submit" onclick="check()" value="Send message">Envoyer le message</button>
</article>

<script>
    function check(){
        name=document.getElementById('nom').value
        surname=document.getElementById('prénom').value
        email=document.getElementById('mail').value
        number=document.getElementById('numéro').value
        message=document.getElementById('message').value
        nameOk=0
        surnameOk=0
        emailOk=0
        numerOk=0
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



        if(email.indexOf("@")!=-1){
            if(email.indexOf(".")!=-1){
                emailOk=1
            }else{
                alert("L'alert doit inclure un . ")
            }
        }else{
            alert("L'email doit inclure un @")
        }


        if(number.search(/^[0-9]/)==0){
            numerOk=1
        }else{
            alert("le numero ne doit inclure seulement des chiffres ")
        }

        
        if(message.search("[\+?{}.'\"/]")==-1){
            messageOk=1
        }else{
            alert("le message ne doit pas contenir de caractere speciale")
        }

        name=document.getElementById('nom').value
        surname=document.getElementById('prénom').value
        email=document.getElementById('mail').value
        number=document.getElementById('numéro').value
        message=document.getElementById('message').value

        console.log(nameOk , surnameOk , emailOk ,numerOk)
        if (nameOk!=0 && surnameOk!=0 && emailOk!=0 && numerOk!=0 && messageOk!=0){
            console.log("php/sendmessage.php?name="+name+"&surname="+surname+"&mail="+email+"&number="+number+"&message="+message+"&agence="+<?php print $Agence; ?>+"&idvoiture=0")


            const xhr = new XMLHttpRequest();
            Requete_Get("php/sendmessage.php?name="+name+"&surname="+surname+"&mail="+email+"&number="+number+"&message="+message+"&agence="+<?php print $Agence; ?>+"&idvoiture=0");
            
        }
    }

    function Requete_Get(url){
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

</body>
</html>