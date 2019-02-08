<?php
    include 'classes/paginaMaestra.php';
    $page = new paginaMaestra();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $page->gethead(); ?>
</head>
<body>
    <?php $page->getcabecera(); ?>
    <div class="container mt-5">
        <div class="row barra_btns p-2 mb-3">
            <div class="col-6 text-center">
                <button id="btn_crear_producto" class="btn btn-outline-dark">Crear un productos</button>
            </div>
            <div class="col-6">
                <button id="btn_mostrar_productos" class="btn btn-outline-dark">Mostrar Todos los productos</button>
            </div>
        </div>
    <!-- Formualrio para creación de productos -->
        <form name="frmCrm" id="frmCrm" class="formulario">
            <div class="row">
                <div class="col-12 col-md-6 text-center nombre_campo">
                    <h4>Nombre</h4>
                </div>
                <div class="col-12 col-md-6 campo">
                    <input type="text" name="txtnombre" id="txtnombre">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-md-6 text-center nombre_campo">
                    <h4>Categoría</h4>
                </div>
                <div class="col-12 col-md-6 campo">
                    <select name="txtcategoria" id="txtcategoria">
                        <option value="" disabled selected>Selecciona una categoría</option>
                        <option value="Smarthphone">Smarthphone</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Portatil">Portatil</option>
                        <option value="Mantenimiento Equipos">Mantenimiento Equipos</option>
                        <option value="Insumos / Materiales">Insumos / Materiales</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-md-6 text-center nombre_campo">
                    <h4>Precio unitario</h4>
                </div>
                <div class="col-12 col-md-6 campo">
                    <input type="number" min="0" max="99999999" name="txtprecio" id="txtprecio">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-md-6 text-center nombre_campo">
                    <h4>Cantidad ordenada</h4>
                </div>
                <div class="col-12 col-md-6 campo">
                    <input type="number" min="0" max="9999" name="txtcanto" id="txtcanto">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-md-6 text-center nombre_campo">
                    <h4>Cantidad en stock</h4>
                </div>
                <div class="col-12 col-md-6 campo">
                    <input type="number" min="0" max="9999" name="txtcants" id="txtcants">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12 col-md-6 text-center">
                    <input type="button" value="guardar" id="btnGuardar" class="btn btn-success">
                </div>
                <div class="col-12 col-md-6">
                <input type="reset" value="Limpiar campos" class="btn btn-danger">
                </div>
            </div>
        </form>
        <!-- Fin formualrio para creación de productos -->
        <!-- Muestra de resultados -->
        <div id="info" class="mt-4">

        </div>
        <div id="resultRecords" class="mt-4 transicion p-5">

        </div>
        <!-- Fin Muestra de resultados -->
    </div>
    <?php $page->getscripts(); ?>
</body>
</html>