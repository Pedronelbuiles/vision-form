<?php 
if (!empty($_POST['entity']) && !empty($_POST['id'])) {
    include 'configuration/config.php';
    $con->connect();
    $entity = $_POST['entity'];
    $id = $_POST['id'];
    $query = "SELECT * FROM $entity WHERE id = '$id'";
    $con->setQuery($query);
    $arrayResult = $con->getArrayRecord();
    $arrayRecord = [
        'id'=>$arrayResult['id'],
        'nombre' => $arrayResult['nombre'],
        'categoria' => utf8_encode($arrayResult['categoria']),
        'precio_unitario' => $arrayResult['precio_unitario'],
        'cantidad_ordenada' => $arrayResult['cantidad_ordenada'],
        'cantidad_stock' => $arrayResult['cantidad_stock'],
        'message' => ''
    ];
}else{
    $arrayResult = ["message" => "Datos incompletos."];
}

echo json_encode($arrayRecord);
