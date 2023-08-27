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
            if($agence==0){

                try
                {
                    $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
                }
                catch (Exception $e)
                {
                        die('Erreur : ' . $e->getMessage());
                }
                $sqlQuery ="SELECT * FROM `presta`" ; 
                $recipesStatement = $db->prepare($sqlQuery);
                $recipesStatement->execute();
                $recipes = $recipesStatement->fetchAll();  
                //print_r($recipes);



?>
                <!DOCTYPE html>
                <html lang="fr">
                <head>
                    <meta charset="utf-8"/>
                    <meta name="description" content="ceci est la page de référence">
                    <title>Notre première page</title>
                    <link rel="stylesheet" href="Css/index.css"/>
                    <style>
                        .prestaprint{
                            display:flex;
                            margin-top:10px;
                        }
                        .prestaprint div{
                            
                            margin-left: 2%;
                        }
                        .prestaprint div p{
                            margin-top: -1%;
                        }
                        section{
                            margin-left:30%;
                        }
                        h1{
                            text-align:center;
                        }
                        #schempresta{
                            margin-left:33%;
                            display:flex;
                        }
                        #schemagence{
                            margin-left:13%;
                        } 
                        #addpresta{
                            margin-left:30%;
                            display:flex;
                        }
                        #goback{
            position:fixed;
        }
                </style>
                </head>
                <body>
                <button id="goback" onclick="window.location.replace('sommaire.php')"><-</button>
                <h1>Page de Modification des Prestations</h1>
                <div id="schempresta">
                <p>Nom</p>
                <p id="schemagence">Agence (separé par un /)</p>
                </div>

                <div id="addpresta">
                <input id="nomajouter">
                <input id="agenceajouter">
                <button onclick="ajouterpresta()">Ajouter une Prestation</button>
                </div>

                <section>
                <?php

for($i=0;$i<count($recipes);$i++){

    echo ' <div class="prestaprint">
    <input id="nom'.$recipes[$i]['IDpresta'].'" value="'.$recipes[$i]['nompresta'].'">
    <input id="agence'.$recipes[$i]['IDpresta'].'" value="'.$recipes[$i]['agence'].'">
    <div>
    <p> Modifier</p>
    <input type="checkbox" onclick="modifier('.$recipes[$i]['IDpresta'].')">
    </div>
    <div>
    <p> Supprimer</p>
    <input type="checkbox" onclick="supprimer('.$recipes[$i]['IDpresta'].')">
    </div>
    </div>';


}

?>
                </section>
                <script>

                    function ajouterpresta(){
                        presta=document.getElementById('nomajouter').value
                        agence=document.getElementById('agenceajouter').value
                        url="ajouter_presta_requete.php?presta="+presta+"&agence="+agence

                        if(agence!="" && presta!=""){
                            Requete_Get(url,actualiser)
                        }else{
                            alert('Les données ne peuvent etre vide')
                        }
                        
                    }


                    function modifier(id){
                        presta=document.getElementById('nom'+id).value
                        agence=document.getElementById('agence'+id).value
                        url="modif_presta_requete.php?presta="+presta+"&agence="+agence+"&id="+id
                        console.log(url)
                        valider=confirm('Voulez vous vraiment Modifier cette prestation ? ')
                        if(valider==true){ 
                            Requete_Get(url,actualiser)
                        }
                    }

                    function supprimer(id){
                        presta=document.getElementById('nom'+id).value
                        agence=document.getElementById('agence'+id).value
                        url="supprimer_presta_requete.php?id="+id
                        console.log(url)
                        valider=confirm('Voulez vous vraiment Supprimer cette prestation ? ')
                        if(valider==true){ 
                            Requete_Get(url,actualiser)
                        }
                        
                    }

                function actualiser(){
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
                            _fonc(str)
                        }
                        
                    }
                    http.send(null)
                    
                }

                    
                </script>
                
                </body>
                </html>


<?php










                        }else{header('Location: ../login.html');}




            /*End Page Web */
        }else{
            header('Location: ../login.html');
        }
        
    }else{
        header('Location: ../login.html');
    }
}else{header('Location: ../login.html');}

?>