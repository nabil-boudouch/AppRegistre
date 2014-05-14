<?php

namespace Gestion\PassBundle\Utils;

class AppRegistre {
    
    //fonction pourcentage
        static public function Pourcentage($Nombre, $Total) {

                 $resultat = $Nombre * 100 / $Total;

                 return number_format($resultat, 2,'.','');

        }
}


?>
