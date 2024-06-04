//Nueva Categoria


document.addEventListener('DOMContentLoaded', function(){
    var formCategorias = document.querySelector("#formCategorias");
    formCategorias.onsubmit = function(e){
        e.preventDefault();

        var intidCategoria = document.querySelector('#idCategoria').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var srtDescripcion = document.querySelector('#txtDescripcion').value;
        var intStatus = document.querySelector('#listEstatus').value;
           
        if(strNombre == '' || srtDescripcion == '' || intStatus == ''){
            swal("Atencion", "Todos los campos son obligatorios", "error");
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/categorias/setCategoria';
        formData = new FormData(formCategorias);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status){
                    $('#modalFormCategorias').modal("hide");
                    formCategorias.reset();
                    swal("Categorias", objData.msg, "success");
                    // tableRoles.api().ajax.reload(function(){
                    //     fntEditRol();
                    //     fntDelRol();
                    //     fntPermisos();
                    // });
                }else{
                    swal("Error", objData.msg, "error");
                }
            }
        }

    }
});







//carga de la foto para las categorias, valida si existe el elemento foto
// y si existe ejecuta el script
document.addEventListener('DOMContentLoaded', function(){
    if(document.querySelector("#foto")){
        var foto = document.querySelector("#foto");
        foto.onchange = function(e) { //se efecuta cuando el input cambia de valor
            var uploadFoto = document.querySelector("#foto").value;
            var fileimg = document.querySelector("#foto").files;
            var nav = window.URL || window.webkitURL;
            var contactAlert = document.querySelector('#form_alert');
            if(uploadFoto !=''){
                var type = fileimg[0].type;
                var name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){ //validacion de los formatos de imagen
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                    if(document.querySelector('#img')){
                        document.querySelector('#img').remove();
                    }
                    document.querySelector('.delPhoto').classList.add("notBlock");//si hay un cambio remueve
                    foto.value="";
                    return false;// limpia la variable
                }else{  
                        contactAlert.innerHTML='';
                        if(document.querySelector('#img')){
                            document.querySelector('#img').remove();
                        }
                        document.querySelector('.delPhoto').classList.remove("notBlock");
                        var objeto_url = nav.createObjectURL(this.files[0]);//se crea un nuevo objeto con la imagen
                        document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src="+objeto_url+">"; //ruta temporal
                    }
            }else{
                alert("No selecciono foto");
                if(document.querySelector('#img')){
                    document.querySelector('#img').remove();
                }
            }
        }
    }
    
    if(document.querySelector(".delPhoto")){
        var delPhoto = document.querySelector(".delPhoto");
        delPhoto.onclick = function(e) {
            removePhoto();
        }
    }
    
    function removePhoto(){//funcion para quitar foto seleccionada
        document.querySelector('#foto').value ="";
        document.querySelector('.delPhoto').classList.add("notBlock");
        document.querySelector('#img').remove();
    }
}, false);

// Para abrir el modal del formulario de registro de categotias
function OpenModal() {
    $('#modalFormCategorias').modal('show');
}

