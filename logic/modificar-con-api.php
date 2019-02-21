<?php
if (!empty($_POST['txtnombre']) && !empty($_POST['txtcategoria']) && !empty($_POST['txtprecio']) && !empty($_POST['txtcanto']) && !empty($_POST['txtcants']) ) {
    
    $nombre = trim(utf8_decode($_POST['txtnombre']));
    $categoria = trim(utf8_decode($_POST['txtcategoria']));
    $precio = trim(utf8_decode($_POST['txtprecio']));
    $canto = trim(utf8_decode($_POST['txtcanto']));
    $cants = trim(utf8_decode($_POST['txtcants']));
    $arrayData = "nombre=$nombre&categoria=$categoria&precio_unitario=$precio&cantidad_ordenada=$canto&cantidad_stock=$cants";
    //url de la apicompleta
    //http://localhost/public/api/productos/agregar?nombre=[nombre del producto]&categoria=[Categoria del producto]&precio_unitario=[Precio del producto]&cantidad_ordenada=[Cantidad ordenada]&cantidad_stock=[Cantidad en stock]
    //Parametros
    //nombre=[nombre del producto]&
    //categoria=[Categoria del producto]&
    //precio_unitario=[Precio del producto]&
    //cantidad_ordenada=[Cantidad ordenada]&
    //cantidad_stock=[Cantidad en stock]
    

    $ch = curl_init('http://localhost/public/api/productos/modificar?');
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $arrayData);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,false);
    $respuesta = curl_exec ($ch);
    curl_close ($ch);
}
?>