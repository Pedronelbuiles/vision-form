<?php
if (!empty($_POST['txtnombre']) && !empty($_POST['txtcategoria']) && !empty($_POST['txtprecio']) && !empty($_POST['txtcanto']) && !empty($_POST['txtcants']) ) {
    include 'configuration/config.php';
    $con->connect();
    $nombre = trim(utf8_decode($_POST['txtnombre']));
    $categoria = trim(utf8_decode($_POST['txtcategoria']));
    $precio = trim(utf8_decode($_POST['txtprecio']));
    $canto = trim(utf8_decode($_POST['txtcanto']));
    $cants = trim(utf8_decode($_POST['txtcants']));
    $query = "UPDATE productos SET categoria = '$categoria', precio_unitario = '$precio', cantidad_ordenada = '$canto', cantidad_stock = '$cants', update_crm = 1 
        WHERE nombre ='$nombre'";
     $con->setQuery($query);
     if ($con->getQuery()) {
         $message = "Ingresado correctamente";
        include 'configuration/authToken.php';    

        $zcrmModuleIns = ZCRMModule::getInstance("Products"); 
        $records=ZCRMRecord::getInstance("Products",null); 
        $records->setFieldValue('Product_Name',$nombre);  
        $records->setFieldValue('Product_Category',$categoria); 
        $records->setFieldValue('Unit_Price',$precio); 
        $records->setFieldValue('Qty_Ordered',$canto); 
        $records->setFieldValue('Qty_in_Stock',$cants); 
        $recordsArray = array($records); 
        $zcrmModuleIns->upsertRecords($recordsArray);
        $APIResponse=$zcrmModuleIns->upsertRecords($recordsArray);
     }else {
        $message = "Error al ingresar";
     }
}else {
    $message = "Falta información";
}
echo json_encode(['message' => $message]);