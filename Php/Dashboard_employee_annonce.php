<?php

//echo $_COOKIE['identifiant'];
//echo $_COOKIE['agence'];
//echo $_COOKIE['fonction'];
//echo $_COOKIE['Date'];
//echo $_COOKIE['SessionID'];

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

            
            //Recuperer les données pour l'agence

        try
        {
            $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }
        if($agence==0){
            $sqlQuery ="SELECT * FROM voiture" ; 
        }else{
            $sqlQuery ="SELECT * FROM voiture WHERE agence=$agence" ; 
        }
        
        $recipesStatement = $db->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();  
        //print_r($recipes);
    $sort="";
  

    $imglstf=[];
    //print "Escape car : ";
    //print "/";
   //print $img;

   //echo count($recipes);
   for($a=0;$a<count($recipes);$a++){
    $searching="";
        $img=$recipes[$a]["img"];
        $imglst=[];
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
        //print_r($imglst);
        array_push($imglstf,$imglst);
   }
   
//print_r($imglstf[1])
    

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
        #searching{
            margin-left: 30%;
        }
        #addingcar{
            margin-top:15px;
        }
        section{
            display: flex;

        }
        h1{
            text-align: center;
        }
        article{
            margin:15px;
        }
        img{
            margin-left:10%;
        }
        article p{
            text-align:center;
        }
                    </style>
                </head>
                <body>
                <button id="goback" onclick="window.location.replace('sommaire.php')"><-</button>
                <div id="searching">
<input id="research">
<button type="button" onclick="check()">Chercher Voiture</button>
    </div>
<button id="addingcar" value="addcar" onclick="window.location.replace('Ajoute_Annonce.php')">Ajouter une voiture</button>
<section id="carbar"> 

<?php 

//print_r($imglstf);
for($i=0;$i<count($imglstf);$i++){
    echo '<article><h1 class="nom">'.$recipes[$i]["nom"].'</h1><img class="onlyimg" src="../assets/'.$imglstf[$i][0].'"></img><p class="parid"> '.$recipes[$i]["ID"].' </p><button onclick="modif('.$recipes[$i]['ID'].')"> Modifier l\'annonce</button><button onclick="supprimer('.$recipes[$i]['ID'].')"> Supprimer l\'annonce</button>  </article>';
}
?>

</section>

            

                
                <script>

function carprint(id){
    
    return " <article><h1 class=\"nom\">"+allcar[id]["carName"]+"</h1><img class=\"onlyimg\" src=\""+allcar[id]["carImg"]+"\"></img><p class=\"parid\"> "+allcar[id]["Id"]+" </p><button onclick=\"modif("+allcar[id]["Id"]+")\"> Modifier l'annonce</button><button onclick=\"supprimer("+allcar[id]["Id"]+")\"> Supprimer l'annonce </button>  </article> "
}

function modif(id)
{
    window.location.replace("Modif_Annonce?id="+id);
}

function supprimer(id){
    validation=confirm("Etes vous sur de vouloir supprimer ce vehicule?")
    if(validation==true){
        console.log("supprimer_annonce.php?id="+id)
        Requete_Get("supprimer_annonce.php?id="+id,actualiser)
    }
}
function actualiser(){
                    location.reload();
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

function check(){
    var search=document.getElementById('research').value
    var section=document.getElementById('carbar')
    section.innerHTML=""
    console.log(allcar[0]['Id']==search)
    console.log()
    console.log(toString(search))
    for(i=0;i<allcar.length;i++){
        if(search==""){
            section.insertAdjacentHTML("beforeend",carprint(i)); 
        }else if(allcar[i]['Id']==search){
            
            section.insertAdjacentHTML("beforeend",carprint(i)); 
        }
    }
}
function Car(id,name,src) {
            this.Id = id;
            this.carName = name;
            this.carImg =src;
        }

            let allcar=[]
                    allelement=document.getElementsByTagName('article')
                    <?php
                    echo'for(i=0;i<allelement.length;i++){
                        var id=document.querySelectorAll(\'.parid\')[i].innerText 
                        var name=document.querySelectorAll(\'.nom\')[i].innerText 
                        var src=document.querySelectorAll(\'.onlyimg\')[i].src
                        console.log()
                        a=new Car(id,name,src) 
                    allcar.push(a)}';
                    
                    ?>



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