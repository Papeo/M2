<?php
namespace Papeo\Fidelite\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {

        echo "route ok";
        if (date("n") == 1) {

            $mois = 12;
            $annee = date("Y") - 1;
        }

        else {

            $mois = date("n") - 1;
            $annee = date("Y");
        }

        $jours_mois = date("t", mktime("0", "0", "0", $mois, "1", $annee));
        echo $jours_mois;
    }
}

