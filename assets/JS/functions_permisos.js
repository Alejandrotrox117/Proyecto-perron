// PERMISOS ////
export function PermisosRol() {
    var btnPermisos = document.querySelectorAll(".btnPermisos");
    btnPermisos.forEach(function (btnPermisos) {
      btnPermisos.addEventListener("click", function () {
        // Obtenemos el id del rol por el atributo "rl"
        var rolId = this.getAttribute("rl");
  
        var request = window.XMLHttpRequest
          ? new XMLHttpRequest()
          : new ActiveXObject("Microsoft.XMLHTTP");
        var ajaxUrl = base_url + "/permisos/getPermisos/" + rolId;
  
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
  export function guardarPermisos() {
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
  