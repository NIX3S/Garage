<?php
$dir = "../Assets";
//  si le dossier pointé existe
if (is_dir($dir)) {
 
   // si il contient quelque chose
   if ($dh = opendir($dir)) {
       // boucler tant que quelque chose est trouvé
        while (($file = readdir($dh)) !== false) {
 
           // affiche le nom et le type si ce n'est pas un élément du système
            if( $file != '.' && $file != '..') {
                if(strpos($file,".jpg") || strpos($file,".jpeg") || strpos($file,".png"))
                echo $file."/";
                // : type : " . filetype($dir . $file) . 
           }
       }
       // on ferme la connection
       closedir($dh);
   }
}
?>