<?php

if(!empty($_GET)){
    if(isset($_GET['identifiant'])&&isset($_GET['password'])){ 
        $identifiant=$_GET['identifiant'];
        $pass=$_GET['password'];
        try{
            $db = new PDO('mysql:host=localhost;dbname=garage;charset=utf8', 'root', '');
        }
        catch (Exception $e){
                die('Erreur : ' . $e->getMessage());
        }

        $options = [
            'cost' => 12,
        ];
        
        $sqlQuery ="SELECT * FROM users WHERE identifiant='".$identifiant."'" ; //.$username;
        $recipesStatement = $db->prepare($sqlQuery);
        $recipesStatement->execute();
        $recipes = $recipesStatement->fetchAll();
        if(empty($recipes)){
            echo "Erreur No user";
        }else{
            $check=password_verify($pass,$recipes[0]["password"]);
            if($check==true){
                $identifiant=$recipes[0]["identifiant"];
                $time=time();
                $text_user="";

                $fonction=$recipes[0]['fonction'];
                $agence=$recipes[0]['agence'];

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

                    $Saltb="directornfeijfe876";
                    $SaltA="directorlojned90";

                    $pass=$SaltA.$text_user.$text_fonction.$text_agence.$text_time.$Saltb;
                    $options = [
                        'cost' => 12,
                    ];
                    $hash = password_hash($pass, PASSWORD_BCRYPT, $options);

                
                setcookie("identifiant",$recipes[0]["identifiant"],  time() + 3600);
                setcookie("agence",$recipes[0]["agence"],  time() + 3600);
                setcookie("fonction",$recipes[0]["fonction"],  time() + 3600);
                setcookie("Date",$time,  time() + 3600);
                setcookie("SessionID",$hash,  time() + 3600);
                // End Cookie 
                echo "auth success";
            }else{
                echo "verification NO";
            };
        };

    }
    
}

?>