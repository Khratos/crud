<?php

$filexml = "Prueba/TSL171218FP7_P6902_20190920.xml";


$xml=simplexml_load_file($filexml) or die("Error: Cannot create object");
// print_r($xml);

$ns = $xml->getNamespaces(true);
$xml->registerXPathNamespace('c', $ns['cfdi']);
$xml->registerXPathNamespace('t', $ns['tfd']);

// // print_r($xml->xpath('//cfdi:Emisor')); //aqui se puede cambiar por cada uno de los campos a conoce
// print_r($xml->xpath('//t:TimbreFiscalDigital')); //aqui se puede cambiar por cada uno de los campos a conoce


// $json = json_encode($xml);
// print_r($json);
echo "<h1>".  "Emisor:". "</h1>";
foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){ 
    print_r( "Nombre: ". $Emisor['Nombre']) ; 
    echo "<br />"; 
    print_r( "RFC: ". $Emisor['Rfc']) ; 
    echo "<br />"; 

 } 
 echo "<h1>".  "Fecha de Timbrado fiscal:". "</h1>";

 foreach ($xml->xpath('//cfdi:Comprobante//t:TimbreFiscalDigital') as $tfd){ 
   //  print_r( $tfd['UUID']);
    print_r( "UUID: ". $tfd['UUID']) ; 
    echo "<br />"; 
    print_r( "Fecha de timbrado: ". $tfd['FechaTimbrado']) ; 
    echo "<br />"; 

 } 


?>