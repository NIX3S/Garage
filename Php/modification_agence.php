
<?php
if(isset($_COOKIE['identifiant']) && isset($_COOKIE['agence']) && isset($_COOKIE['fonction']) && isset($_COOKIE['Date']) && isset($_COOKIE['SessionID'])  && isset($_GET['id'])){
    //echo "OK";
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
                $sqlQuery ="SELECT * FROM `agence` WHERE Id=".$_GET['id'] ; 
                $recipesStatement = $db->prepare($sqlQuery);
                $recipesStatement->execute();
                $recipes = $recipesStatement->fetchAll();  
                //print_r($recipes);
            
                $result=$recipes;


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
            text-align:center;
        }
        td input{
            width: 50px;
        }
        article{
            margin-left:40%;
        }
        table{
            margin-left:27%;
            text-align:center;
        }
        input[type=button]{
            width: 300px;
    margin-left: 37%;
    margin-top: 20px;
        }
                </style>
                </head>
                <body>
                <button id="goback" onclick="window.location.replace('admin_agence.php')"><-</button>
                
                <section>
                    <h1 >Modification de l'Agence <?php print $_GET['id']; ?></h1>
                    <article>
                    <p>Nom : <input id="Agence" value="<?php print $NomAgence; ?>"></p>
                    <p>Adresse : <input id="Adresse" value="<?php print $Adresse; ?>"> </p>
                    <p>Mail :   <input id="mail" value="<?php print $mail; ?> "></p>
                    <p>N° : <input id="number" value="<?php print $number; ?>"> </p>
                    </article>
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
                                <td><input id="LundiAM" value="<?php print $LundiAM; ?>"></td>
                                <td><input id="MardiAM" value="<?php print $MardiAM; ?>"></td>
                                <td><input id="MercrediAM" value="<?php print $MercrediAM; ?>"></td>
                                <td><input id="JeudiAM" value="<?php print $JeudiAM; ?>"></td>
                                <td><input id="VendrediAM" value="<?php print $VendrediAM; ?>"></td>
                                <td><input id="SamediAM" value="<?php print $SamediAM; ?>"></td>
                                <td><input id="DimancheAM" value="<?php print $DimancheAM; ?>"></td>

                            </tr>
                            <tr>
                                <td>Aprés-Midi</td>
                                <td><input id="LundiPM" value="<?php print $LundiPM; ?>"></td>
                                <td><input id="MardiPM" value="<?php print $MardiPM; ?>"></td>
                                <td><input id="MercrediPM" value="<?php print $MercrediPM; ?>"></td>
                                <td><input id="JeudiPM" value="<?php print $JeudiPM; ?>"></td>
                                <td><input id="VendrediPM" value="<?php print $VendrediPM; ?>"></td>
                                <td><input id="SamediPM" value="<?php print $SamediPM; ?>"></td>
                                <td><input id="DimanchePM" value="<?php print $DimanchePM; ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <input type="button" value="Modifier" onclick="modification()">


                <script>
                    function modification(){ 
                        let Agence= document.getElementById('Agence').value
                        let Adresse= document.getElementById('Adresse').value
                        let mail= document.getElementById('mail').value
                        let number= document.getElementById('number').value
                        let LundiAM= document.getElementById('LundiAM').value
                        let MardiAM= document.getElementById('MardiAM').value
                        let MercrediAM= document.getElementById('MercrediAM').value
                        let JeudiAM= document.getElementById('JeudiAM').value
                        let VendrediAM= document.getElementById('VendrediAM').value
                        let SamediAM= document.getElementById('SamediAM').value
                        let DimancheAM= document.getElementById('DimancheAM').value
                        let LundiPM= document.getElementById('LundiPM').value
                        let MardiPM= document.getElementById('MardiPM').value
                        let MercrediPM= document.getElementById('MercrediPM').value
                        let JeudiPM= document.getElementById('JeudiPM').value
                        let VendrediPM= document.getElementById('VendrediPM').value
                        let SamediPM= document.getElementById('SamediPM').value
                        let DimanchePM= document.getElementById('DimanchePM').value


                        var url="modification_agence_requete.php?Agence="+Agence+"&mail="+mail+"&Adresse="+Adresse+"&number="+number+"&LundiAM="+LundiAM+"&MardiAM="+MardiAM+"&MercrediAM="+MercrediAM+"&JeudiAM="+JeudiAM+"&VendrediAM="+VendrediAM+"&SamediAM="+SamediAM+"&DimancheAM="+DimancheAM+"&LundiPM="+LundiPM+"&MardiPM="+MardiPM+"&MercrediPM="+MercrediPM+"&JeudiPM="+JeudiPM+"&VendrediPM="+VendrediPM+"&SamediPM="+SamediPM+"&DimanchePM="+DimanchePM+"&id=<?php echo $_GET['id']; ?>"
                        Requete_Get(url,reloadingpage)
                    }

                    function reloadingpage(){
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
                            _fonc()
                        }
                        
                    }
                    http.send(null)
                    }
                </script>
                </body>
                </html>

                
<?php
    
            }
            //echo $_GET['id'];
            /*End Page Web */
        }else{
            echo "Cookies as expired";
        }
        
    }else{
        echo "Bad account ";
    }
}

?>
