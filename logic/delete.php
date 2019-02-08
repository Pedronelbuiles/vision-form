<?php 
include 'configuration/config.php';
$con->connect();
if(!empty($_POST['tabla']) && !empty($_POST['nombre']) ){
    $tabla = $_POST['tabla'];
    $nombre = $_POST['nombre'];
    $query = "DELETE FROM $tabla WHERE nombre = '$nombre'";
    $con->setQuery($query);
    if ($con->getQuery()) {
        $message = "Registro eliminado";
    }else {
        $message = "error al eliminar";
    }
    
}else {
    $message = "faltaron datos";
}
echo json_encode(['message' => $message]);