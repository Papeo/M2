<?php

if (file_exists('test.xml')) {
    $xml = simplexml_load_file('test.xml');

    $xml = json_encode($xml);

    $xml2 = json_decode($xml, true);
//  $nomProduit = $xml->{'tracking_number'};

//  $hello = $xml->{'tracking_number'};

    var_dump($xml2);

    echo "uy". $xml2["id_utilisateur"];

}
