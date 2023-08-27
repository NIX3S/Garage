<?php
if(isset($_COOKIE['identifiant']) && isset($_COOKIE['agence']) && isset($_COOKIE['fonction']) && isset($_COOKIE['Date']) && isset($_COOKIE['SessionID'])){

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

                ?>


                <!DOCTYPE html>
                <html lang="fr">
                  <head>
                    <meta charset="utf-8"/>
                    <meta name="description" content="ceci est la page de référence">
                    <title>Notre première page</title>
                    <link rel="stylesheet" href="Css/index.css"/>
                
                <style>
                    #chooseimg {
                    display: none;
                    width: 140vh;
                    height: 100Vh;
                    background-color: lightgray;
                    top: 0;
                    z-index: 21;
                    position: fixed;
                    }

                    #chooseimg form{
                        margin-top: 11px;

                    }
                    #chooseimg img{
                        margin:10px;
                    }
                    
                    #goback{
            position:fixed;
        }
        h1{
            text-align:center;
        }
        #imagesection{
            display: flex;
        }
        #imagesection div{
            margin:15px;
        }
        #addelement{
            margin-left: 42%;
        }
        #buttonajout{
            margin-left: 90%;
        }
                    </style>    
                
                
                </head>
                  <body>
                  <button id="goback" onclick="window.location.replace('Dashboard_employee_annonce.php')"><-</button>
                  <h1>Ajouter une nouvelle voiture</h1>
                  <section id="chooseimg">
                    <button id="close" onclick="closeimg()"> close</button>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                    <div id="IMGdiv">
                    </div>
                    <p id="file">None</p>
                    <button id="validate" onclick="valid()"> Valider </button>
                </section>


                <section id="imagesection">
                
                <div id="container1">
                <img class="img" id="imgsrc1" src="../Assets/1.png" width="100px" height="150px" alt="Venice" onclick="openimgchooser(1)"> 
                <button  value="Ajouter" onclick="addchoixpossible()">+</button>
                </div>

    </section>  
               
                
                
                
                
                <section id="addelement">
                <p>nom <input id="nom" value=""></p>
                <p>agence <input id="agence" value=""></p>
                <p>Km <input id="Km" value=""></p>
                <p>Prix <input id="Prix" value=""></p>
                <p>Année <input id="Année" value=""></p>
                <p>Description <input id="Description" value=""></p>
                <p>moteur <input id="moteur" value=""></p>
                <p>nbporte <input id="nbporte" value=""></p>
                <p>puissance <input id="puissance" value=""></p>
                <p>puissance fiscale <input id="pfiscale" value=""></p>
                <p>conso route <input id="consoroute" value=""></p>
                <p>conso mixte <input id="consomixte" value=""></p>
                <p>conso autoroute <input id="consoautoroute" value=""></p>

                <p>options <input id="options" value=""></P>
                <p>équipement <input id="equipements" value=""></P>
                <p>avantage <input id="avantage" value=""></P>
                <p>incovenient <input id="incovenient" value=""></p>


                </section>
                
                
                <button id="buttonajout" value="ajouter" onclick="ajoutermodification()">Ajouter la Voiture</button>
                
                
                
                
                
                
                <script>
                function Supprimerchoixpossible(id){
                    document.getElementById('container'+id).remove()
                }

                function addchoixpossible(){ 
                let long=document.querySelectorAll('img').length
                long=Number(long-1)
                console.log(long)
                let lastid=document.querySelectorAll('img')[long].id.replace("imgsrc","")
                lastid=Number(lastid)
                
                let valeur="<div id=\"container"+(lastid+1)+"\" ><img class=\"img\" id=\"imgsrc"+(lastid+1)+"\" src=\"../Assets/1.png\" width=\"100px\" height=\"150px\" alt=\"Venice\" onclick=\"openimgchooser("+(lastid+1)+")\"> <button value=\"Ajouter\" onclick=\"addchoixpossible()\">+</button><button value=\"Supprimer\" onclick=\"Supprimerchoixpossible("+(lastid+1)+")\">-</button></div>"
                
                document.getElementById('imagesection').insertAdjacentHTML("beforeend",valeur)
                
            }


                
                function checkimg(str){
                    document.getElementById("chooseimg").style.display="block"
                    document.getElementById("IMGdiv").innerHTML=""
                    arr=Array()
                    src=""
                    for(i=0;i<str.length;i++){
                        if(str[i]!="/"){
                            src+=str[i]
                        }else{
                            var value='<img width="100px" height="150px" src="../Assets/'+ src+'" onclick="imgsrc(\''+src+'\')" >'
                            document.getElementById("IMGdiv").insertAdjacentHTML("beforeend",value)
                            arr.push(src)
                            src=""
                        }
                    }
                }
                
                function imgsrc(elt){
                    if(id!=0){
                        //document.getElementById("img"+id).value=elt
                        document.getElementById("imgsrc"+id).src="../Assets/"+elt
                        document.getElementById('file').innerText=elt
                        document.getElementById("chooseimg").style.display="none"
                    }else{
                        //document.getElementById("img"+id).value=elt
                        document.getElementById("imgsrc"+id).src="../Assets/"+elt
                        document.getElementById('file').innerText=elt
                        document.getElementById("chooseimg").style.display="none"
                    }
                
                }

                function openimgchooser(uniqueid){
                    id=uniqueid
                    Requete_Get("check_img.php",checkimg) 
                }
                
                function actualiser(){
                    window.location.replace("Modif_Annonce.php");
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
                
                function closeimg(){
                    document.getElementById("chooseimg").style.display="none"
                }

                



                function checkifisin(chaine,elt,toverif){ 
                        if(chaine.indexOf(toverif)==-1){
                            return 1
                        }else{
                            alert(elt+" ne doit pas inclure un @")
                            return 0
                        }
                        }
                
                </script>
                <script>
                    function ajoutermodification(){ 

                        let nom=document.getElementById('nom').value
                        let agence=document.getElementById('agence').value
                        let km=document.getElementById('Km').value
                        let prix=document.getElementById('Prix').value
                        let année=document.getElementById('Année').value
                        let descript=document.getElementById('Description').value
                        let moteur=document.getElementById('moteur').value
                        let nbporte=document.getElementById('nbporte').value
                        let puissance=document.getElementById('puissance').value
                        let pfiscale=document.getElementById('pfiscale').value
                        let consoroute=document.getElementById('consoroute').value
                        let consomixte=document.getElementById('consomixte').value
                        let consoautoroute=document.getElementById('consoautoroute').value
                        let options=document.getElementById('options').value
                        let equipements=document.getElementById('equipements').value
                        let avantage=document.getElementById('avantage').value
                        let incovenient=document.getElementById('incovenient').value


                        let nomOK=checkifisin(nom,"nom","/")
                        let agenceOK=checkifisin(agence,"agence","/")
                        let kmOK=checkifisin(km,"km","/")
                        let prixOK=checkifisin(prix,"prix","/")
                        let annéeOK=checkifisin(année,"année","/")
                        let descriptOK=checkifisin(descript,"descript","/")
                        let moteurOK=checkifisin(moteur,"moteur","/")
                        let nbporteOK=checkifisin(nbporte,"nbporte","/")
                        let puissanceOK=checkifisin(puissance,"puissance","/")
                        let pfiscaleOK=checkifisin(pfiscale,"pfiscale","/")
                        let consorouteOK=checkifisin(consoroute,"consoroute","/")
                        let consomixteOK=checkifisin(consomixte,"consomixte","/")
                        let consoautorouteOK=checkifisin(consoautoroute,"consoautoroute","/")
                        let optionsOK=checkifisin(options,"options","/")
                        let equipementsOK=checkifisin(equipements,"equipements","/")
                        let avantageOK=checkifisin(avantage,"avantage","/")
                        let incovenientOK=checkifisin(incovenient,"incovenient","/")

                        allimg=document.querySelectorAll('.img')
                        imgrslt=""
                        for(i=0;i<allimg.length;i++){
                            if(i!=0){
                                imgrslt+="/"
                            }
                            src=allimg[i].src
                            imgrslt+=src.replace('http://localhost/Garage/Assets/',"")
                        }
                        console.log(imgrslt)


                        if(kmOK==1 &&prixOK==1 &&annéeOK==1 &&descriptOK==1 &&moteurOK==1 &&nbporteOK==1 &&puissanceOK==1 &&pfiscaleOK==1 &&consorouteOK==1 &&consomixteOK==1 &&consoautorouteOK==1 &&optionsOK==1 &&equipementsOK==1 &&avantageOK==1 &&incovenientOK==1 && nomOK==1 && agenceOK==1){

                            console.log("Yes")

                            a="Ajoute_Annonce_requete.php?km="+km+"&prix="+prix+"&année="+année+"&descript="+descript+"&moteur="+moteur+"&nbporte="+nbporte+"&puissance="+puissance+"&pfiscale="+pfiscale+"&consoroute="+consoroute+"&consomixte="+consomixte+"&consoautoroute="+consoautoroute+"&options="+options+"&equipements="+equipements+"&nom="+nom+"&agence="+agence+"&avantage="+avantage+"&incovenient="+incovenient+"&imgrslt="+imgrslt

                            console.log(a)
                            Requete_Get(a,actualiser)

                        }
                  }

                        

                </script>
                
                </body>
                  </html>










<?php                

            /*End Page Web */
        }else{
            echo "Cookies as expired";
        }
        
    }else{
        echo "Bad account ";
    }
}
?>
