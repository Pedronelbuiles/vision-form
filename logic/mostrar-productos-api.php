<?php
include 'configuration/config.php';
include 'configuration/authToken.php';
$zcrmModuleIns = ZCRMModule::getInstance("Products");
$bulkAPIResponse=$zcrmModuleIns->getRecords();
$recordsArray = $bulkAPIResponse->getData(); // $recordsArray - array of ZCRMRecord instances
$arrayDentro = $recordsArray['0'];

//print_r($arrayDentro);
//print_r($arrayDentro);
$otroArray = (array) $arrayDentro;
$ultimoArray = json_encode($otroArray);
$arrayDelProducto = json_decode($ultimoArray, true);
//$ultimoArray['\u0000ZCRMRecord\u0000fieldNameVsValue'];

//*********************************** Esto lo hice para recorrer el arrat que cree de la respueta del crm */

foreach($arrayDelProducto as $nombre => $elemento){
    if(strcmp($nombre,'[ZCRMRecordfieldNameVsValue]')){
        print_r($elemento);
        echo "\n";
    }
}
//print_r($otroArray['fieldNameVsValue:ZCRMRecord:private']);
//print_r($ultimoArray);
//return $ultimoArray;
// echo $otroArray['entityId:ZCRMRecord:private'].' Es el id de '.$arrayDentro['']
//echo json_encode(['datos' => $ultimoArray]);