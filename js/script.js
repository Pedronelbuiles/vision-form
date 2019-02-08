$(function(){
    $('#btnGuardar').click(function() {
        guardarRecords();
    });
    $('#btn_token').click(function() {
        getToken();
    });
    $('#btn_crear_producto').click(function(){
        mostrar_form();
    });
    $('#btn_mostrar_productos').click(function(){
        mostrar_productos();
    });
});
function listRecords() {
    $.ajax({
        'url':'logic/mostrar_bd.php',
        'type':'POST',
        'dataType':'json',
        'success' : function(data) {
            $('#resultRecords').html(data.table);
        }
    });
};
function guardarRecords(){
    $.ajax({
        'url':'logic/guardar.php',
        'data':$('#frmCrm').serialize(),
        'type':'POST',
        'datatype':'json',
        'success':function(data){
            $('#info').html(data.message);
            listRecords();
            mostrar_form();
        }
    });
};
function deleteRecord(tabla, nombre) {
    $.ajax({
        'url':'logic/delete.php',
        'data': {'tabla':tabla, 'nombre':nombre},
        'type': 'POST',
        'dataType': 'json',
        'success': function(data) {
            $('#info').html(data.message);
            listRecords();
        }
    });
};
function mostrar_form() {
    $('#frmCrm').fadeToggle('fast','linear');
}
function mostrar_productos() {
    $('#resultRecords').fadeToggle('fast','linear');
    listRecords();
}