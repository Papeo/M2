<?php


namespace Papeo\ApiRealisaprint\Cron;


class RecuperationFichier
{
    public function __construct(

    \Papeo\ApiRealisaprint\Helper\RecuperationFichier $recuperationFichierHelper

){
    $this->_recuperationFichierHelper = $recuperationFichierHelper;

}

    public function execute(){

        $this->_recuperationFichierHelper->recupTracking();
    }

}
