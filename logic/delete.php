<?php 
include 'configuration/config.php';
$con->connect();
if(!empty($_POST['tabla']) && !empty($_POST['id']) ){
    $tabla = $_POST['tabla'];
    $id = $_POST['id'];
    $query = "DELETE FROM $tabla WHERE id = '$id'";
    $con->setQuery($query);
    if ($con->getQuery()) {
        include 'configuration/authToken.php';
        $zcrmRecordIns = ZCRMRecord::getInstance("Products", $id); //record id
        $apiResponse=$zcrmRecordIns->delete();
        $message = "Registro eliminado";
    }else {
        $message = "error al eliminar";
    }
    
}else {
    $message = "faltaron datos";
}
echo json_encode(['message' => $message]);