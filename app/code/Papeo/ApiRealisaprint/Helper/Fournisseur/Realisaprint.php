<?php


namespace Papeo\ApiRealisaprint\Helper\Fournisseur;


class Realisaprint
{


    public function testApi()
    {



        $url = "https://www.realisaprint.com/api/products";
        $data =[

            "shop_id" => 76,
            "api_key" =>"f9ca76b8a0945b510a5b1f3e751e975a"
        ];

// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
//        $toto=file_get_contents($url, false, $context);
//        //transforme le Json en ARRAY
//        $toto=strtr($toto,"[[],[],","");
//        $toto= json_decode($toto);
//        echo "<pre>";
//        var_dump($toto);
        $result = json_decode($result);

        foreach ($result->products as $product)
            echo $product. "<br>";
        if ($result === FALSE) { /* Handle error */ }




            }

//A partir d'un artcicle de commande, je souhaite créer une commande  chez RW
//Cette méthode renvoie le numéro de commande et le prix chez RW
// En entrée je lui passe tous les paramètres que me donne la doc pdf
    public function genereCommande(\Magento\Sales\Model\Order\Item $item)
    {
        $externalOrderId = "";

        $option = [
            "qty" => $item->getQtyOrdered()


            ];
        $url = "https://www.realisaprint.com/api/create_order";
        $data =[

            "shop_id" => 76,
            "api_key" =>"f9ca76b8a0945b510a5b1f3e751e975a"
        ];

// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $result = json_decode($result);

    }

}


////The url you wish to send the POST request to
//$url = $file_name;
//
////The data you want to send via POST
//$fields = [
//    '__VIEWSTATE ' => $state,
//    '__EVENTVALIDATION' => $valid,
//    'btnSubmit' => 'Submit'
//];
//
////url-ify the data for the POST
//$fields_string = http_build_query($fields);
//
////open connection
//$ch = curl_init();
//
////set the url, number of POST vars, POST data
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
//
////So that curl_exec returns the contents of the cURL; rather than echoing it
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
////execute post
//$result = curl_exec($ch);
//echo $result;

