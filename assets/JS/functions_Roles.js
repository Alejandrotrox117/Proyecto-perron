var tablaRoles;

import { PermisosRol} from './functions_permisos.js';


//Datatable con sus atributos
document.addEventListener("DOMContentLoaded", function () {
  tablaRoles = $("#tablaRoles").DataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      decimal: "",
      emptyTable: "No hay información",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
      infoFiltered: "(Filtrado de _MAX_ total entradas)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Entradas",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    ajax: {
      url: base_url + "/roles/getRoles",
      dataSrc: "",
    },
    columns: [
      { data: "nombre" },
      { data: "descripcion" },
      { data: "estado" },
      { data: "acciones" },
    ],
    destroy: true,
    responsive: true,
    pageLength: 10,
    order: [[0, "asc"]],
  });

  // Crear un nuevo rol
  var formRol = document.querySelector("#formRol");
  formRol.onsubmit = function (e) {
    e.preventDefault();
    var rolId = document.querySelector("#rolId").value;
    var nombreRol = document.querySelector("#txtRol").value;
    var descRol = document.querySelector("#txtDescripcion").value;
    var estatusRol = document.querySelector("#listEstatus").value;

    if (nombreRol == "" || descRol == "" || estatusRol == "") {
      swal("Atención", "Todos los campos son obligatorios", "error");
      return false;
    }

    var request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    // Ajax para insertar datos
    var ajaxUrl = base_url + "/roles/setRol";

    var formData = new FormData(formRol);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        var objData = JSON.parse(request.responseText);

        if (objData.status) {
          $("#modalFormRol").modal("hide");
          formRol.reset();
          swal("Rol de usuario", objData.msg, "success");

          // Después de insertar un nuevo rol con éxito
          tablaRoles.ajax.reload(function () {
            // Cargamos nuevamente las roles
            // para que se actualizen en la vista
            EditRol();
            DeleteRol();
            PermisosRol();
          });
        } else {
          swal("Error", objData.msg, "error");
        }
      }
    };
  };
});

// Para abrir el modal del formulario de registro de roles
function OpenModalRol() {
  $("#modalFormRol").modal("show");
  document.querySelector("#rolId").value = "";
  document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
  document.querySelector("#btnActionForm").classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Rol";
  document.querySelector("#formRol").reset();
}
document.getElementById("btnModalRol").addEventListener("click", function() {
  OpenModalRol();
});
//funcion load para que se carguen los modales
window.addEventListener(
  "load",
  function () {
    EditRol();
    DeleteRol();
    PermisosRol();
  },
  false
);

//Editar rol
function EditRol() {
  const btnEditRol = document.querySelectorAll(".btnEditRol");
  btnEditRol.forEach(btn => {
    btn.addEventListener("click", () => {
      // Actualizar el modal
      document.querySelector("#titleModal").innerHTML = "Actualizar Rol";
      document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
      document.querySelector("#btnActionForm").classList.replace("btn-primary", "btn-info");
      document.querySelector("#btnText").innerHTML = "Actualizar";

      // Obtener el id del rol
      const rolId = btn.getAttribute("rl");

      // Realizar la solicitud AJAX
      const ajaxUrl = base_url + "/roles/getOneRol/" + rolId;
      const request = new XMLHttpRequest();
      request.open("GET", ajaxUrl, true);
      request.onload = () => {
        if (request.status >= 200 && request.status < 400) {
          const objData = JSON.parse(request.responseText);
          if (objData.status) {
            // Rellenar el modal con los datos del rol
            document.querySelector("#rolId").value = objData.data.rolId;
            document.querySelector("#txtRol").value = objData.data.nombre;
            document.querySelector("#txtDescripcion").value = objData.data.descripcion;
            document.querySelector("#listEstatus").value = objData.data.estado;

            // Mostrar el modal
            $("#modalFormRol").modal("show");
          } else {
            swal("Error", objData.msg, "error");
          }
        } else {
          swal("Error", "No se pudo obtener la información del rol.", "error");
        }
      };
      request.onerror = () => {
        swal("Error", "Error de conexión.", "error");
      };
      request.send();
    });
  });
}
//Funcion para eliminar un rol

function DeleteRol() {
  var btnEliRol = document.querySelectorAll(".btnEliRol");
  btnEliRol.forEach(function (btnEliRol) {
    btnEliRol.addEventListener("click", function () {
      var rolId = this.getAttribute("rl");
      //alerta de confirmacion de eliminar generada con sweetAlert
      swal(
        {
          title: "Eliminar Rol",
          text: "¿Estas seguro de eliminar el rol?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Si, eliminar!",
          cancelButtonText: "No, cancelar!",
          closeOnConfirm: false,
          closeOnCancel: true,
        },
        function (isConfirm) {
          if (isConfirm) {
            var request = window.XMLHttpRequest
              ? new XMLHttpRequest()
              : new ActiveXObject("Microsoft.XMLHTTP");
            var ajaxUrl = base_url + "/roles/delRol";
            var strData = "rolId=" + rolId;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader(
              "Content-type",
              "application/x-www-form-urlencoded"
            );
            request.send(strData);
            request.onreadystatechange = function () {
              if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                  swal("Eliminar Rol", objData.msg, "success");
                  tablaRoles.ajax.reload(function () {
                    EditRol();
                    DeleteRol();
                    PermisosRol();
                  });
                } else {
                  swal("Error", objData.msg, "error");
                }
              }
            };
          }
        }
      );
    });
  });
}

