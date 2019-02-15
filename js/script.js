$(function(){
    $('#btnGuardar').click(function() {
        guardarRecords();
    });
    $('#btn_token').click(function() {
        getToken();
    });
    $('#bntModificar').click(function() {
        updateRecord();
    });
    $('#bntApi').click(function() {
        alimentarApi();
    });
    $('#btn_crear_producto').click(function(){
        $('#btnGuardar').attr('disabled',false);
        $('#bntModificar').attr('disabled',true);
        mostrar_form();
    });
    $('#btn_mostrar_productos').click(function(){
        mostrar_productos();
    });
    $('#btnActualizar').click(function() {
       mostrarTodos();
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
            $('#frmCrm').trigger('reset');
            mostrar_productos();

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
};
function mostrar_productos() {
    $('#resultRecords').fadeToggle('fast','linear');
    listRecords();
};


function updateRecord() {
    $.ajax({
        'url':'logic/modificar-registro.php',
        'data':$('#frmCrm').serialize(),
        'type':'POST',
        'datatype':'json',
        'success':function(data){
            $('#info').html(data.message);
            listRecords();
            $('#frmCrm').trigger('reset');
            mostrar_productos();
        }
    });
}

function getRecord(entity, id) {
    $.ajax({
        'url':'logic/findRecord.php',
        'data':{'entity':entity,'id':id},
        'type':'POST',
        'dataType':'json',
        'success':function(data) {
            if (data.message === '') {
                $('#txtnombre').val(data.nombre);
                $('#txtcategoria').val(data.categoria);
                $('#txtprecio').val(data.precio_unitario);
                $('#txtcanto').val(data.cantidad_ordenada);
                $('#txtcants').val(data.cantidad_stock);
            }else{
                $('#dialog').html(data.message);
                $('#dialog').dialog({
                    autoOpen: true,
                    modal:true,
                    buttons: {
                        'Cerrar': function() {
                            $(this).dialog('close');
                        }
                    }
                });
            }
        }
    });
    $('#btnGuardar').attr('disabled',true);
    $('#bntModificar').attr('disabled',false);
    mostrar_form();
};
function alimentarApi() {
    $.ajax({
      'url': 'logic/alimentar-api.php', 
      'type': 'POST',
      'datatype': 'json',
      'data': $('#frmCrm').serialize()
    });
    $('#frmCrm').trigger('reset');
    $('#frmCrm').fadeToggle('fast','linear');
    listRecords();
    mostrar_productos();
  };
function mostrarTodos() {
        $.ajax({
            'url':'logic/mostrar-productos-api.php',
            'type':'POST',
            'datatype':'json',
            'success': function (data) {
                
            }
        });
};
