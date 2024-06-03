var tablaRoles;

document.addEventListener('DOMContentLoaded', function () {
    tablaRoles = $('#tablaRoles').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
        },
        "ajax": {
            "url": base_url + "/roles/getRoles",
            "dataSrc": ""
        },
        "columns": [
            { "data": "rol_id" },
            { "data": "nombre" },
            { "data": "descripcion" },
            { "data": "estatus"},
            { "data": "acciones"}
        ],
        "destroy": true,
        "responsive": true,
        "pageLength": 10,
        "order": [[0, "asc"]]
    });

    // Crear un nuevo rol
    var formRol = document.querySelector("#formRol");
    formRol.onsubmit = function (e) {
        e.preventDefault();
        var nombreRol = document.querySelector("#txtRol").value;
        var descRol = document.querySelector("#txtDescripcion").value;
        var estatusRol = document.querySelector("#listEstatus").value;

        if (nombreRol == "" || descRol == "" || estatusRol == "") {
            swal("Atención", "Todos los campos son obligatorios", "error");
            return false;
        }
        
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        // Ajax para insertar datos
        var ajaxUrl = base_url + '/roles/setRol';

        var formData = new FormData(formRol);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
               
                if (objData.status) {
                $('#modalFormRol').modal('hide');
                formRol.reset();
                swal("Rol de usuario", objData.msg, "success");
                   // Después de insertar un nuevo rol con éxito
                    tablaRoles.ajax.reload(null, false);

                } else {
                    swal("Error", objData.msg, "error");
                }
            }
        };
        
    };
});

// Para abrir el modal del formulario de registro de roles
function OpenModal() {
    $('#modalFormRol').modal('show');
}