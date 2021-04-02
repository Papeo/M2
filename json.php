<!DOCTYPE html>
<html>
<head>
    <title>Un document HTML formel</title>

    <style>
        textarea {
            background-color: #e2e4e7;
        }

    </style>

</head>
<body>
<?php

function textarea_to_array($var)
{
    $var = trim($var);

    $var = htmlspecialchars($var, ENT_QUOTES);
    $var = explode("\r\n", $var);

    function trim_entries(&$value)
    {
        $value = trim($value);
    }

    array_walk($var, 'trim_entries');

    return $var;
}

function textarea_to_array2($var2)
{
    $var2 = trim($var2);

    $var2 = htmlspecialchars($var2, ENT_QUOTES);
    $var2 = explode("\r\n", $var2);

    function trim_entries2(&$value)
    {
        $value = trim($value);
    }

    array_walk($var2, 'trim_entries');

    return $var2;
}

function after($sep, $inthat)
{
    if (!is_bool(strpos($inthat, $sep)))
        return substr($inthat, strpos($inthat, $sep) + strlen($sep));
}

$qte = textarea_to_array($_POST['quantite']);
$colonne = textarea_to_array2($_POST['colonne']);
$nbTarifs = count($colonne);
$url = $_POST['url'];
$remise = $_POST['remise'];
$idUrl = after('FP', $url);
$paramExa = $_POST['variable'];



// Affiche le produit
$urlSeo = "https://www.exaprint.fr/catalogue/products-price/?id=" . $idUrl;
echo $urlSeo. "<br>https://www.exaprint.fr/fiche-produit/products-prices-custom/?id=" . $idUrl . "&quantity=" . $qte[0];;

//transforme le Json en ARRAY
$parsed_json = json_decode($urlSeo);
$nomProduit = $parsed_json->{'urlSeo'};
echo "<h2>" . $nomProduit . "</h2>";

echo "<br>Il y a ".$nbTarifs . " tarifs<br>";
?>

<table>
    <td>
<textarea name="quantite" rows="1" cols="5">Quantité</textarea>
<?php for ($i = 0; $i< $nbTarifs ; $i++) { ?>
    <textarea name="colonne" rows="1" cols="5"><?php echo $colonne[$i]; ?></textarea>
    <textarea name="idproduit" rows="1" cols="5">idProd.></textarea>

<?php }?>
    </td>
</table>


<table>

    <td>
<textarea name="Quantité" rows="50" cols="5">
<?php
foreach ($qte as $qtes) {
    echo $qtes . "\n";
}
?>
</textarea>
    </td>
    <?php for ($i = 0; $i< $nbTarifs ; $i++) { ?>


        <td>


<textarea name="Prix" rows="50" cols="5" >
<?php

foreach ($qte as $qtes) {
    $url = "https://www.exaprint.fr/fiche-produit/products-prices-custom/?id=" . $idUrl . "&quantity=" . $qtes;
    $toto = file_get_contents($url);
//transforme le Json en ARRAY
    $toto=strtr($toto,"[[],[],","");
    $parsed_json = json_decode($toto);
    //echo $toto;
    $prix = $parsed_json->{'productsPrices'}[$i]->{$paramExa}->{$qtes}->{'prix'};


    $quantite = $parsed_json->{'productsPrices'}[$i]->{$paramExa}->{$qtes}->{'quantite'};
    $productId = $parsed_json->{'productsPrices'}[$i]->{$paramExa}->{$qtes}->{'productID'};
    $prix = ($prix * 0.9)*$remise;
    $prix = sprintf("%.2f", $prix);
    echo $prix . "\n";

} ?>
</textarea>
        </td>
        <td>
        <textarea name="idProduit" rows="50"  cols="5">
<?php
foreach ($qte as $qtes) {
    $url = "https://www.exaprint.fr/fiche-produit/products-prices-custom/?id=" . $idUrl . "&quantity=" . $qtes;
    $toto = file_get_contents($url);
//transforme le Json en ARRAY
    $parsed_json = json_decode($toto);

    echo $productId . "\n";
} ?>

</textarea>
        </td>

    <?php }
    ?>

</table>
</body>


</html>





