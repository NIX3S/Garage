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
            ?>
            <!DOCTYPE html>
            <html lang="fr">
              <head>
                <meta charset="utf-8"/>
                <meta name="description" content="ceci est la page de référence">
                <title>Notre première page</title>
                <link rel="stylesheet" href="Css/index.css"/>
                <style>
                    h1{
                        text-align:center;
                    }
                    div{
                        display:flex;
                        flex-direction:column;
                    }
                    a{
                        margin-top:10px;
                        font-size:15px;
                        text-align:center;
                    }
              </style>
              </head>
              <body>
              <h1>Bienvenu <?php print $identifiant; ?> (<?php print $fonction; ?>) sur la Page de Sommaire </h1>
              <div>
              <a href="../login.html">Page de Login<a>
              <a href="admin_contact.php">Page de Message<a>
              <a href="admin_avis.php">Page de Traitement des Avis<a>
              <a href="avis_admin.php">Page d'envois des Avis<a>
              <a href="Dashboard_employee_annonce.php">Page de voiture<a>
          
          
              <?php if($agence==0){ ?>
              <a href="admin_register.php">Page de User<a>
              <a href="admin_agence.php">Page de Agence<a>
              <a href="modif_presta.php">Page de Prestation<a>
                <?php } ?>
              </div>
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