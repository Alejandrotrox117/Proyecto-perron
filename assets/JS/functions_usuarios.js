window.addEventListener('load', function() {
    fntRolesUsuario();
}, false);

function fntRolesUsuario() {
    var ajaxUrl = base_url + '/roles/getSelectRoles';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listRolid').innerHTML = request.responseText;
            document.querySelector('#listRolid').value = 1;
            $('#listRolid').selectpicker('render');
        }
    }
}

function OpenModalUser()
{
$("#modalFormUser").modal('show'); 
document.querySelector("#UsuarioId").value = "";
document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
document.querySelector("#btnActionForm").classList.replace("btn-info", "btn-primary");
document.querySelector("#btnText").innerHTML = "Guardar";
document.querySelector("#titleModal").innerHTML = "Nuevo Rol";
document.querySelector("#formRol").reset();
}