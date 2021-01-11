<?php
if ( isset($_REQUEST['flux']) && !empty($_REQUEST['flux']) )
{
// on place l'adresse dans la variable $url (plus court à écrire)
$url = $_REQUEST['flux'];
// on charge le contenu du fichier XML dans la variable $fileContents
$fileContents = file_get_contents($url);

$fileContents = str_replace("media:", "media", $fileContents);

// on supprime éventuellement les caractères spéciaux (retour chariot, tabulation..)
// qui pourrait poser problème lors de la conversion au format json
$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
// idem avec les guillements simples ou doubles
$fileContents = trim(str_replace('"', "'", $fileContents));
// conversion du contenu XML nettoyé en objet simpleXML (librairie php)
$simpleXml = simplexml_load_string($fileContents, 'SimpleXMLElement', LIBXML_NOCDATA);
// conversion de l'objet simpleXML en chaine json
$json = json_encode($simpleXml);
// envoie au client
echo $json;
}
else
echo "[error] Parameter flux is not defined or empty";
?>