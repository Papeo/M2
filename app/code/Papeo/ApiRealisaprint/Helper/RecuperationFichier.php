<?php


namespace Papeo\ApiRealisaprint\Helper;


class RecuperationFichier extends \Magento\Framework\App\Helper\AbstractHelper
{


    public function recupTracking()
    {

       // mail('studio@papeo.fr', 'Fichier Xml récupéré','Done !' );
        $local_file = './apiimport/local2.xml';


// Mise en place d'une connexion basique
        $conn_id = ftp_connect('ns31236374.ip-51-178-178.eu');


// Identification avec un nom d'utilisateur et un mot de passe
        $login_result = ftp_login($conn_id, 'ftp-papeo.org', 'Pipa@6868');

// Tentative de téléchargement du fichier $server_file et sauvegarde dans le fichier $local_file
        if (ftp_get($conn_id, $local_file, 'httpdocs/M241/test.xml', FTP_BINARY)) {
            echo "Le fichier $local_file a été écrit avec succès\n";
        } else {
            echo "Il y a un problème\n";
        }

        if (file_exists('./apiimport/local2.xml')) {
            $xml = simplexml_load_file('./apiimport/local2.xml');
       //     mail('studio@papeo.fr', 'Fichier Xml récupéré','Done !' );

            $tracking_number = $xml->{'product'}->{'tracking_number'};
            $tracking_link = $xml->{'product'}->{'tracking_link'};
            $ref_order_realisaprint = $xml->{'ref_order_realisaprint'};
            return ["tracking_number"=>$tracking_number, "tracking_link"=>$tracking_link, "ref_order_realisaprint"=>$ref_order_realisaprint];

        }
// Fermeture de la connexion
        ftp_close($conn_id);
    }
}


