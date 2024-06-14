var tablaRoles;
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
      //{ "data": "rol_id" },
      { data: "nombre" },
      { data: "descripcion" },
      { data: "estatus" },
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
    var idRol = document.querySelector("#idRol").value;
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
  document.querySelector("#idRol").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("headerUpdate", "headerRegister");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Rol";
  document.querySelector("#formRol").reset();
}

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
  var btnEditRol = document.querySelectorAll(".btnEditRol");
  btnEditRol.forEach(function (btnEditRol) {
    btnEditRol.addEventListener("click", function () {
      //Para cambiar el nomrbre del modal al hacer click en actualizar
      document.querySelector("#titleModal").innerHTML = "Actualizar Rol";
      //cambia el tiutlo del modal de insertar a actualizar
      document
        .querySelector(".modal-header")
        .classList.replace("headerRegister", "headerUpdate");
      // cambia el nombre de guardar a actualizar
      document
        .querySelector("#btnActionForm")
        .classList.replace("btn-primary", "btn-info");
      document.querySelector("#btnText").innerHTML = "Actualizar";

      //Obtener el id del rol por el atributo rl
      var idRol = this.getAttribute("rl");
      //para obtener el rol depnediendo del navegador que se este usando
      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      // Ajax para buscar la informacion con la url de la funcion getOneRol
      var ajaxUrl = base_url + "/roles/getOneRol/" + idRol;
      request.open("GET", ajaxUrl, true);
      request.send();
      //para obtener la informacion del rol y autorellenar el modal
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          var objData = JSON.parse(request.responseText);
          if (objData.status) {
            //obtenemos los valores de cada input del modal utilizando value
            document.querySelector("#idRol").value = objData.data.rol_id;
            document.querySelector("#txtRol").value = objData.data.nombre;
            document.querySelector("#txtDescripcion").value =
              objData.data.descripcion;
            document.querySelector("#listEstatus").value = objData.data.estatus;

            // Establecer el valor seleccionado del elemento listEstatus
            var listEstatus = document.querySelector("#listEstatus");
            if (objData.data.estatus === 1) {
              listEstatus.selectedIndex = 0; // Activo
            } else {
              listEstatus.selectedIndex = 1; // Inactivo
            }

            $("#modalFormRol").modal("show");
          } else {
            swal("Error", objData.msg, "error");
          }
        }
      };
    });
  });
}

//Funcion para eliminar un rol

function DeleteRol() {
  var btnEliRol = document.querySelectorAll(".btnEliRol");
  btnEliRol.forEach(function (btnEliRol) {
    btnEliRol.addEventListener("click", function () {
      var idRol = this.getAttribute("rl");
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
            var strData = "idRol=" + idRol;
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

// PERMISOS ////
function PermisosRol() {
  var btnPermisos = document.querySelectorAll(".btnPermisos");
  btnPermisos.forEach(function (btnPermisos) {
    btnPermisos.addEventListener("click", function () {
      // Obtenemos el id del rol por el atributo "rl"
      var idRol = this.getAttribute("rl");

      var request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      var ajaxUrl = base_url + "/permisos/getPermisos/" + idRol;

      // Peticion GET para obtener los permisos del rol
      request.open("GET", ajaxUrl, true);

      // Enviamos la petición
      request.send();

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          // Mostramos los permisos
          document.querySelector("#contenidoAjax").innerHTML =
            request.responseText;
          $("#modalPermisos").modal("show");
          document.querySelector("#btnGuardarPermiso").addEventListener(
            "click",
            function (e) {
              e.preventDefault();
              guardarPermisos();
            },
            false
          );
        }
      };
    });
  });
}

// función para guardar el permiso
function guardarPermisos() {
  var request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  var ajaxUrl = base_url + "/permisos/setPermisos";
  var formElement = document.querySelector("#formPermisos");
  var formData = new FormData(formElement);
  request.open("POST", ajaxUrl, true);
  request.send(formData);

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);
      if (objData.status) {
        swal("Permisos de usuario", objData.msg, "success");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}
