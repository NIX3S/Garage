<?php
if(isset($_COOKIE['identifiant']) && isset($_COOKIE['agence']) && isset($_COOKIE['fonction']) && isset($_COOKIE['Date']) && isset($_COOKIE['SessionID']) && isset($_GET['id']) ){

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
            $id=$_GET['id'];
            if($agence!=-1){


                try
                {
                    $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
                }
                catch (Exception $e)
                {
                        die('Erreur : ' . $e->getMessage());
                }
                $sqlQuery ="SELECT * FROM `voiture` WHERE ID=".$id ; 
                $recipesStatement = $db->prepare($sqlQuery);
                $recipesStatement->execute();
                $recipes = $recipesStatement->fetchAll();  
                //print_r($recipes);
                $result=$recipes;

                $nom=$recipes[0]["nom"];
                $agence=$recipes[0]["Agence"];
                $img=$recipes[0]["img"];
                $km=$recipes[0]['km'];
                $prix=$recipes[0]['prix'];
                $année=$recipes[0]['année'];
                $descript=$recipes[0]['descript'];
                $moteur=$recipes[0]['moteur'];
                $nbporte=$recipes[0]['nbporte'];
                $puissance=$recipes[0]['puissance'];
                $pfiscale=$recipes[0]['pfiscale'];
                $consoroute=$recipes[0]['consoroute'];
                $consomixte=$recipes[0]['consomixte'];
                $consoautoroute=$recipes[0]['consoautoroute'];

                $options=$recipes[0]['options'];
                $equipements=$recipes[0]['equipements'];
                $avantage=$recipes[0]['avantage'];
                $incovenient=$recipes[0]['incovenient'];
                $ID=$recipes[0]['ID'];


                $imglst=[];
                //print "Escape car : ";
                //print "/";
               //print $img;
               $searching="";
               for($i=0; $i<strlen($img);$i++){
                   //print $img[$i];
                   
                   if($img[$i]!="/"){
                       $searching=$searching.$img[$i];
                       //print $searching;
                   }else{
                       //print "NO";
                       //print $searching;
                       array_push($imglst,$searching);
                       $searching="";
                       //print_r($imglst);
                   }
                   
               }
               array_push($imglst,$searching);

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
        #modifelement{
            margin-left: 42%;
        }
        #buttonModif{
            margin-left: 90%;
        }
                    </style> 

                    </style>    
                
                
                </head>
                  <body>
                  <button id="goback" onclick="window.location.replace('Dashboard_employee_annonce.php')"><-</button>
                <h1>Modification de la voiture</h1>
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
                
                    <?php
                    $firstdone=0;
                for($i=0;$i<count($imglst);$i++){
                    if($firstdone==0){ 
            print  "<div id=\"container".$i."\">
                <img class=\"img\" id=\"imgsrc".$i."\" src=\"../Assets/".$imglst[$i]."\" width=\"100px\" height=\"150px\" alt=\"Venice\" onclick=\"openimgchooser(".$i.")\"> 
                <button value=\"Ajouter\" onclick=\"addchoixpossible()\">+</button>
                </div>";
                $firstdone=1;
            }else{
                print  "<div id=\"container".$i."\">
                <img class=\"img\" id=\"imgsrc".$i."\" src=\"../Assets/".$imglst[$i]."\" width=\"100px\" height=\"150px\" alt=\"Venice\" onclick=\"openimgchooser(".$i.")\"> 
                <button value=\"Ajouter\" onclick=\"addchoixpossible()\">+</button>
                <button value=\"Supprimer\" onclick=\"Supprimerchoixpossible(".$i.")\">-</button>
                </div>";
            }

        } 
        
        
        
        
        
        
        ?>
                
    </section>  
               
                
                
                
                
                <section id="modifelement">
                <p>nom <input id="nom" value="<?php print $nom; ?> "></p>
                <p>agence <input id="agence" value="<?php print $agence; ?> "></p>
                <p>Km <input id="Km" value="<?php print $km; ?> "></p>
                <p>Prix <input id="Prix" value="<?php print $prix; ?>"></p>
                <p>Année <input id="Année" value="<?php print $année; ?>"></p>
                <p>Description <input id="Description" value="<?php print $descript; ?>"></p>
                <p>moteur <input id="moteur" value="<?php print $moteur; ?>"></p>
                <p>nbporte <input id="nbporte" value="<?php print $nbporte; ?>"></p>
                <p>puissance <input id="puissance" value="<?php print $puissance; ?>"></p>
                <p>puissance fiscale <input id="pfiscale" value="<?php print $pfiscale; ?>"></p>
                <p>conso route <input id="consoroute" value="<?php print $consoroute; ?>"></p>
                <p>conso mixte <input id="consomixte" value="<?php print $consomixte; ?>"></p>
                <p>conso autoroute <input id="consoautoroute" value="<?php print $consoautoroute; ?>"></p>

                <p>options <input id="options" value="<?php print $options; ?>"></P>
                <p>équipement <input id="equipements" value="<?php print $equipements; ?>"></P>
                <p>avantage <input id="avantage" value="<?php print $avantage; ?>"></P>
                <p>incovenient <input id="incovenient" value="<?php print $incovenient; ?>"></p>


                </section>
                
                
                <button id="buttonModif" value="modifier" onclick="launchmodification()">Modifier la voiture</button>
                
                
                
                
                
                
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
                    //location.reload()
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
                    function launchmodification(){ 

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

                            a="modif_annonce_requete.php?km="+km+"&prix="+prix+"&année="+année+"&descript="+descript+"&moteur="+moteur+"&nbporte="+nbporte+"&puissance="+puissance+"&pfiscale="+pfiscale+"&consoroute="+consoroute+"&consomixte="+consomixte+"&consoautoroute="+consoautoroute+"&options="+options+"&equipements="+equipements+"&nom="+nom+"&agence="+agence+"&avantage="+avantage+"&incovenient="+incovenient+"&imgrslt="+imgrslt+"&id="+<?php print $id; ?>

                            console.log(a)
                            Requete_Get(a,actualiser)

                        }
                  }

                        

                </script>
                
                </body>
                  </html>










<?php                

            }
            /*End Page Web */
        }else{
            echo "Cookies as expired";
        }
        
    }else{
        echo "Bad account ";
    }
}
?>
