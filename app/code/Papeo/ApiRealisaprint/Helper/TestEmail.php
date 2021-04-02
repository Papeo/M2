<?php


namespace Papeo\ApiRealisaprint\Helper;


class TestEmail
{

       public function execute()
    {

        mail('studio@papeo.fr', 'Fichier Xml récupéré','Done !' );

        return $this;

    }


}


