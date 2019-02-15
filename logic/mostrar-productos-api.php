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

//print_r($otroArray['fieldNameVsValue:ZCRMRecord:private']);
//print_r($ultimoArray);
//return $ultimoArray;
// echo $otroArray['entityId:ZCRMRecord:private'].' Es el id de '.$arrayDentro['']
//echo json_encode(['datos' => $ultimoArray]);