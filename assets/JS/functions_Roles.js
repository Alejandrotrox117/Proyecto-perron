var tablaRoles;

document.addEventListener('DOMContentLoaded', function () {
    tablaRoles = $('#tablaRoles').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": base_url + "/roles/getRoles",
            "dataSrc": ""
        },
        "columns": [
            { "data": "rol_id" },
            { "data": "nombre" },
            { "data": "estatus" },
            { "data": "descripcion" }
        ],
        "bDestroy": true,
        "responsive": true,
        "pageLength": 10,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });


});



//para abrir modal del formulario de registro de roles
function OpenModal() {
    $('#modalFormRol').modal('show');
}