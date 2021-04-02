<?php


namespace Papeo\Formation\Plugin;
use Psr\Log\LoggerInterface;



class ModifAvantSafeData
{
    public function __construct(LoggerInterface $logger)
    {
        $this->_logger = $logger;

    }


    // bien voir les paramètres ne entrée
    public function beforeSaveData(\Papeo\Formation\Model\RevendeurRepository $revendeurRepository, array $data) {
        $this->_logger->critical("le fichier avant modif est" .$data["Nom"] );
        $data["Nom"] = $data["Nom"]."$";
        $this->_logger->critical("le fichier après modif est" .$data["Nom"] );
        return [$data];

    }



}
