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
            { "data": "descripcion" },
            { "data": "estatus"},
            { "data": "acciones"}

           
        ],
        "destroy": true,
        "responsive": true,
        "pageLength": 10,
        "order": [[0, "asc"]]
    });
});

// Para abrir el modal del formulario de registro de roles
function OpenModal() {
    $('#modalFormRol').modal('show');
}