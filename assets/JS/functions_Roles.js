var tablaRoles;

document.addEventListener('DOMContentLoaded', function () {
    tablaRoles = $('#tablaRoles').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": base_url + "/roles/getRoles",
            "dataSrc": ""
        },
        "columns": [
            { "data": "rol_id" },
            { "data": "nombre" },
            { 
                "data": "estatus",
                "render": function (data, type, row) {
                    if (data == "1") {
                        return '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        return '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
                }
            },
            { "data": "descripcion" }
        ],
        "destroy": true,
        "responsive": true,
        "pageLength": 10,
        "order": [[0, "desc"]]
    });
});

// Para abrir el modal del formulario de registro de roles
function OpenModal() {
    $('#modalFormRol').modal('show');
}