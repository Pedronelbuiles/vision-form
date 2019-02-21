<?php
include 'configuration/config.php';
$entity = "productos";
$con->connect();
$query = "SELECT * FROM $entity";
$con->setQuery($query);
$nreg = $con->totalRecords();
$table = "<div class='row encabezado_tabla'>
            <div class='col-3'>Nombre</div>
            <div class='col-2'>Categoría</div>
            <div class='col-2'>Precio unitario</div>
            <div class='col-1'>Cantidad ordenada</div>
            <div class='col-1'>Cantidad en stock</div>
            <div class='col-1'>Actualizado en CRM</div>
            <div class='col-2'>Acciones</div>
        </div>";
while ($row = $con->getArrayRecord()) {
    $id = $row['id'];
    $table .= "<div class='row mt-2 contenedor_padre'>
                <div class='col-3'>".utf8_encode($row['nombre'])."</div>
                <div class='col-2'>".utf8_encode($row['categoria'])."</div>
                <div class='col-2'>".utf8_encode($row['precio_unitario'])."</div>
                <div class='col-1'>".utf8_encode($row['cantidad_ordenada'])."</div>
                <div class='col-1'>".utf8_encode($row['cantidad_stock'])."</div>
                <div class='col-1'>".utf8_encode($row['update_crm'])."</div>
                <div class='col-2 text-center'>
                    <a href='#!' class='btn btn-danger btn-sm MyBtn' title='Eliminar a ".utf8_encode($row['nombre'])."' onclick='if(confirm(\"¿Estas seguro?\")){deleteRecord(\"$entity\", \"$id\");}'>Eliminar</a>
                    <a href='#!' class='btn btn-light btn-sm mt-2 MyBtn' title='Modificar a ".utf8_encode($row['nombre'])."' onclick='getRecord(\"$entity\", \"$id\");'>Modificar</a>
                </div>
            </div>";
}
$table .="<div class='row'>
            <div class='col-12 text-center'>
                <p>Total Productos: ".$nreg."</p>
            </div>
        </div>";
$con->freeQuery();
$con->closeConnection();
$arrayResult = ['table' => $table];
echo json_encode($arrayResult);

