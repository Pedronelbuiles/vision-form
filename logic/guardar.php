<?php
if (!empty($_POST['txtnombre']) && !empty($_POST['txtcategoria']) && !empty($_POST['txtprecio']) && !empty($_POST['txtcanto']) && !empty($_POST['txtcants']) ) {
    include 'configuration/config.php';
    $con->connect();
    $nombre = trim(utf8_decode($_POST['txtnombre']));
    $categoria = trim(utf8_decode($_POST['txtcategoria']));
    $precio = trim(utf8_decode($_POST['txtprecio']));
    $canto = trim(utf8_decode($_POST['txtcanto']));
    $cants = trim(utf8_decode($_POST['txtcants']));
    $query = "INSERT INTO productos(nombre, categoria, precio_unitario, cantidad_ordenada, cantidad_stock)
     VALUES ('$nombre','$categoria', '$precio', '$canto', '$cants')";
     $con->setQuery($query);
     if ($con->getQuery()) {
         $message = "Ingresado correctamente";
        include 'configuration/authToken.php';    
        $zcrmModuleIns = ZCRMModule::getInstance("Products"); // Creo un objeto con la definicion del modulo a modo de instancia
        //configuro un objeto con toda la información para subir los dato 
        $records=ZCRMRecord::getInstance("Products",null); //Le digo que se guardará en el modulo Proudctos con id null
        $records->setFieldValue('Product_Name',$nombre);  //Agrego los campos a llenar con la variable que contiene la información
        $records->setFieldValue('Product_Category',$categoria); //Agrego los campos a llenar con la variable que contiene la información
        $records->setFieldValue('Unit_Price',$precio); //Agrego los campos a llenar con la variable que contiene la información
        $records->setFieldValue('Qty_Ordered',$canto); //Agrego los campos a llenar con la variable que contiene la información
        $records->setFieldValue('Qty_in_Stock',$cants); //Agrego los campos a llenar con la variable que contiene la información
        $recordsArray = array($records); //Lleno el array para enviar los datos
        //$zcrmModuleIns->upsertRecords($recordsArray); // Este metodo es utilizado para que si el objeto ya existe se sobreescriba de lo contrario de cree
        $APIResponse=$zcrmModuleIns->createRecords($recordsArray); //Aqui Enviamos y creamos el record al crm

        //Ejemplo
        // $zcrmModuleIns = ZCRMModule::getInstance("Products"); 
        // $records=ZCRMRecord::getInstance("Products",null); 
        // $records->setFieldValue('Product_Name',$nombre);  
        // $records->setFieldValue('Product_Category',$categoria); 
        // $records->setFieldValue('Unit_Price',$precio); 
        // $records->setFieldValue('Qty_Ordered',$canto); 
        // $records->setFieldValue('Qty_in_Stock',$cants); 
        // $recordsArray = array($records); 
        // $zcrmModuleIns->upsertRecords($recordsArray);
        // $APIResponse=$zcrmModuleIns->createRecords($recordsArray);
     }else {
        $message = "Error al ingresar";
     }
}else {
    $message = "Falta información";
}
echo json_encode(['message' => $message]);
