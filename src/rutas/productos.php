<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app =  new \Slim\App;

//Obtener todos los registros
$app->get('/api/productos', function(Request $request, Response $response){

    $query = 'SELECT * FROM productos';

    try {
        //Instanciar la bd
        include '../logic/configuration/config.php';
        $con->connect();
        $con->setQuery($query);
        $prueba = array();
        $i=0;
        while ($row = $con->getArrayRecord()){
            $prueba[$i] = $row;
            $i++;
        }
        $con->freeQuery();
        $con->closeConnection();

        //exportar el contenido en  json
        echo json_encode($prueba);
    } catch (PDOException $e) {
        echo '{"error":{"text": '.$e->getMessage().'}';
    }

});
//Obtener registro especifico
$app->get('/api/productos/{nombre}', function(Request $request, Response $response){

    $nombre = $request->getAttribute('nombre');
    $query = "SELECT * FROM productos WHERE nombre='$nombre'";

    try {
        //Instanciar la bd
        include '../logic/configuration/config.php';
        $con->connect();
        $con->setQuery($query);
        $prueba = array();
        $i=0;
        while ($row = $con->getArrayRecord()){
            $prueba[$i] = $row;
            $i++;
        }
        $con->freeQuery();
        $con->closeConnection();

        //exportar el contenido en  json
        echo json_encode($prueba);
    } catch (PDOException $e) {
        echo '{"error":{"text": '.$e->getMessage().'}';
    }

});

//Agregar un registro
$app->post('/api/productos/agregar', function(Request $request, Response $response,  $args){

    //Obtener datos de los parametros
    $nombre = $request->getParam('nombre');
    $categoria = $request->getParam('categoria');
    $precio_unitario = $request->getParam('precio_unitario');
    $cantidad_ordenada = $request->getParam('cantidad_ordenada');
    $cantidad_stock = $request->getParam('cantidad_stock');
    $query = "INSERT INTO productos(nombre, categoria, precio_unitario, cantidad_ordenada, cantidad_stock)
    VALUES (:nombre,:categoria, :precio_unitario, :cantidad_ordenada, :cantidad_stock)";
    
    try {
        //Instanciar la bd
        include '../logic/configuration/config.php';
        $db = $con->conectar();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':categoria',  $categoria);
        $stmt->bindParam(':precio_unitario', $precio_unitario);
        $stmt->bindParam(':cantidad_ordenada', $cantidad_ordenada);
        $stmt->bindParam(':cantidad_stock', $cantidad_stock);
        $stmt->execute();
        //Ingresar datos en crm
        include '../logic/configuration/authToken.php';
        $zcrmModuleIns = ZCRMModule::getInstance("Products"); 
        $records=ZCRMRecord::getInstance("Products",null); 
        $records->setFieldValue('Product_Name',$nombre);  
        $records->setFieldValue('Product_Category',$categoria); 
        $records->setFieldValue('Unit_Price',$precio_unitario); 
        $records->setFieldValue('Qty_Ordered',$cantidad_ordenada); 
        $records->setFieldValue('Qty_in_Stock',$cacantidad_stock); 
        $recordsArray = array($records); 
        $zcrmModuleIns->upsertRecords($recordsArray);
        $APIResponse=$zcrmModuleIns->createRecords($recordsArray);
        echo '{"notice": {"text": "Registro agregado"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": '.$e->getMessage().'}';
    }

});