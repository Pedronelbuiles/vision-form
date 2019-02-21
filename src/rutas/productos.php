<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app =  new \Slim\App;
function agregar_id($id, $nombre)
{
    include '../logic/configuration/config.php';
    $con->connect();
    $query = "UPDATE productos SET id = $id WHERE nombre = $nombre";
    $con->setQuery($query);
}

function guardar_crm($nombre , $categoria, $precio_unitario, $cantidad_ordenada, $cacantidad_stock)
{
    
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
    $entityResponses = $APIResponse->getEntityResponses();
    $idProducto;
    foreach ($entityResponses as $entityResponse) { 
        if ("success"==$entityResponse->getStatus()) { 
            $createdRecordInstance=$entityResponse->getData(); 
            $idProducto = $createdRecordInstance->getEntityId(); 
        }
    }
    return $idProducto;
}
//Obtener todos los registros
$app->get('/api/productos', function(Request $request, Response $response){

    $query = 'SELECT * FROM productos';

    try {
        //Instanciar la bd
        include '../logic/configuration/config.php';
        $con->connect();
        $con->setQuery($query);
        $respuestaJson = array();
        $i=0;
        while ($row = $con->getArrayRecord()){
            $respuestaJson[$i] = $row;
            $i++;
        }
        $con->freeQuery();
        $con->closeConnection();

        //exportar el contenido en  json
        echo json_encode($respuestaJson);
    } catch (PDOException $e) {
        echo '{"error":{"text": '.$e->getMessage().'}';
    }

});
//Obtener registro especifico
//buscando por el id
$app->get('/api/productos/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');
    $query = "SELECT * FROM productos WHERE id='$id'";

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
    
    $query = "INSERT INTO productos(id, nombre, categoria, precio_unitario, cantidad_ordenada, cantidad_stock)
    VALUES (:id,:nombre,:categoria, :precio_unitario, :cantidad_ordenada, :cantidad_stock)";
    
    
        //Instanciar la bd
        include '../logic/configuration/config.php';
        $db = $con->conectar();
        //agregar a la bd
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', guardar_crm($nombre, $categoria, $precio_unitario, $cantidad_ordenada, $cantidad_stock));
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':categoria',  $categoria);
        $stmt->bindParam(':precio_unitario', $precio_unitario);
        $stmt->bindParam(':cantidad_ordenada', $cantidad_ordenada);
        $stmt->bindParam(':cantidad_stock', $cantidad_stock);
        $stmt->execute();
        
        echo '{"notice": {"text": "Registro agregado"}';
    

});
//Modificar un registro 
$app->post('/api/productos/modificar', function(Request $request, Response $response,  $args){

    //Obtener datos de los parametros
    $id = $request->getParam('id');
    $nombre = $request->getParam('nombre');
    $categoria = $request->getParam('categoria');
    $precio_unitario = $request->getParam('precio_unitario');
    $cantidad_ordenada = $request->getParam('cantidad_ordenada');
    $cantidad_stock = $request->getParam('cantidad_stock');
    
    $query = "UPDATE productos SET nombre = :nombre, categoria = :categoria, precio_unitario = :precio_unitario, cantidad_ordenada = :cantidad_ordenada, cantidad_stock = :cantidad_stock
    WHERE id = :id";
    
    try {
        //Instanciar la bd
        include '../logic/configuration/config.php';
        $db = $con->conectar();
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':categoria',  $categoria);
        $stmt->bindParam(':precio_unitario', $precio_unitario);
        $stmt->bindParam(':cantidad_ordenada', $cantidad_ordenada);
        $stmt->bindParam(':cantidad_stock', $cantidad_stock);
        $stmt->execute();
        //Actualizar datos en crm
        include '../logic/configuration/authToken.php';
        $zcrmModuleIns = ZCRMModule::getInstance("Products"); 
        $records=ZCRMRecord::getInstance("Products",$id); 
        $records->setFieldValue('Product_Name',$nombre);  
        $records->setFieldValue('Product_Category',$categoria); 
        $records->setFieldValue('Unit_Price',$precio_unitario); 
        $records->setFieldValue('Qty_Ordered',$cantidad_ordenada); 
        $records->setFieldValue('Qty_in_Stock',$cacantidad_stock); 
        $recordsArray = array($records); 
        $zcrmModuleIns->upsertRecords($recordsArray);
        $APIResponse=$zcrmModuleIns->upsertRecords($recordsArray);
        echo '{"notice": {"text": "Registro modificado"}';
    } catch (PDOException $e) {
        echo '{"error":{"text": '.$e->getMessage().'}';
    }

});
