<?php


namespace Papeo\Formation2\Plugin;




class DollarProduit
{



    public function afterGetNom(\Papeo\Formation2\Model\Cadeau $cadeau,$resultat ) {


        return str_replace("a","$",$resultat);
    }

}

