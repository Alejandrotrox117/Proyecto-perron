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
        var idRol = document.querySelector('#idRol').value;
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
function OpenModalRol() {
    $('#modalFormRol').modal('show');
        document.querySelector('#idRol').value = "";
        document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
        document.querySelector('#btnActionForm').classList.replace('btn-info', 'btn-primary');
        document.querySelector('#btnText').innerHTML = 'Guardar';
        document.querySelector('#titleModal').innerHTML = 'Nuevo Rol';
        document.querySelector("#formRol").reset();
}

// Editar rol
window.addEventListener('load', function () {
    EditRol();
}, false);

function EditRol() {
    var btnEditRol = document.querySelectorAll(".btnEditRol");
    btnEditRol.forEach(function (btnEditRol) {
        btnEditRol.addEventListener('click', function () {
           //Para cambiar el nomrbre del modal al hacer click en actualizar
            document.querySelector('#titleModal').innerHTML = 'Actualizar Rol';
            document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
            document.querySelector('#btnActionForm').classList.replace('btn-primary', 'btn-info');
            document.querySelector('#btnText').innerHTML = 'Actualizar';
            
            //Obtener el id del rol por el atributo rl
            var idRol = this.getAttribute('rl');
            //para obtener el rol depnediendo del navegador que se este usando
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            // Ajax para buscar la informacion con la url del metodo getOneRol
            var ajaxUrl = base_url + '/roles/getOneRol/' + idRol;
            request.open("GET", ajaxUrl, true);
            request.send();
            //para obtener la informacion del rol y autorellenar el modal
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    console.log (objData);
                    if (objData.status) {
                        //obtenemos los valores de cada input del modal utilizando value
                        document.querySelector('#idRol').value = objData.data.rol_id;
                        document.querySelector('#txtRol').value = objData.data.nombre;
                        document.querySelector('#txtDescripcion').value = objData.data.descripcion;
                        document.querySelector('#listEstatus').value = objData.data.estatus;
                        
                       // Crear una variable para almacenar el HTML de las opciones
                       // usamos el operador ternario ejemplo   -> condicion ? resultado_verdadero : resultado_falso
                        var optionsHTML = objData.data.estatus === 1
                        ? '<option value="1" selected class="notBlock">Activo</option>'
                        : '<option value="0" class="notBlock">Inactivo</option>';

                        // Generar el HTML para las opciones adicionales utilizando map
                        var additionalOptions = ['Activo', 'Inactivo'].map(function(option) {
                        return `<option value="${option.toLowerCase()}">${option}</option>`;
                        });

                        // Combinar el HTML de la opción seleccionada y las opciones adicionales
                        var htmlSelect = optionsHTML + additionalOptions.join('');

                        // Actualizar el contenido del elemento listEstatus con el nuevo HTML
                        document.querySelector('#listEstatus').innerHTML = htmlSelect;
                                                $('#modalFormRol').modal('show');
                    }else{
                        swal("Error", objData.msg, "error");
                    }
                }
            }
        });
    });
}
