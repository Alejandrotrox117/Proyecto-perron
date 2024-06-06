
document.addEventListener('DOMContentLoaded', function(){

    //DataTable
    var tablaCategoria;
    tablaCategoria = $('#tablaCategoria').DataTable({
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
            "url": base_url + "/categorias/getCategoria",
            "dataSrc": ""
        },
        "columns": [
            { "data": "categoriaId" },
            { "data": "nombre" },
            { "data": "descripcion" },
            { "data": "estadoId"},
            { "data": "acciones"}
        ],
        "destroy": true,
        "responsive": true,
        "pageLength": 10,
        "order": [[0, "asc"]]
    });

    //Crear Categoria
    var formCategorias = document.querySelector("#formCategorias");
    formCategorias.onsubmit = function(e){
        e.preventDefault();

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
                    removePhoto();
                    swal("Categorias", objData.msg, "success");
                    tablaCategoria.ajax.reload(null, false);
                    tablaCategoria.api().ajax.reload(function(){
                        btnViewInfo();
                        btnEditInfo();
                    //     fntPermisos();
                    });
                }else{
                    swal("Error", objData.msg, "error");
                }
            }
        }

    }

    var closeButton = document.querySelector('.close');
    closeButton.addEventListener('click', function() {
        removePhoto();
    });
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
            document.querySelector("#foto_remove").value = 1;
            removePhoto();
        }
    }
}, false);

function btnViewInfo(idcategoria){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/categorias/getAcategoria/'+idcategoria;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData != '')
            {
                let estado = objData.estadoId == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';
                document.querySelector("#celId").innerHTML = objData.categoriaId;
                document.querySelector("#celNombre").innerHTML = objData.nombre;
                document.querySelector("#celDescripcion").innerHTML = objData.descripcion;
                document.querySelector("#celEstado").innerHTML = estado;
                document.querySelector("#imgCategoria").innerHTML = '<img src="'+objData.url_portada+'"></img>';
                $('#modalViewCategoria').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function btnEditInfo(idcategoria){
    document.querySelector('.tile-title').innerHTML ="Actualizar Categoría";
    document.querySelector('.modal-title').innerHTML ="Actualizar Categoría";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').innerHTML ="Actualizar";

    var idcategoria = idcategoria;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/categorias/getAcategoria/'+idcategoria;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
    if(request.readyState == 4 && request.status == 200){
    let objData = JSON.parse(request.responseText);
            if(objData != '')
            {
                document.querySelector("#idCategoria").value = objData.categoriaId;
                document.querySelector("#txtNombre").value = objData.nombre;
                document.querySelector("#txtDescripcion").value = objData.descripcion;
                document.querySelector("#foto_actual").value = objData.portada;
                document.querySelector("#foto_remove").value = 0;

                if(objData.estadoId == '1'){
                    parseInt(document.querySelector('#listEstatus').value = 1);
                }else{
                    parseInt(document.querySelector('#listEstatus').value = 2);
                }
                
                //$('#listEstatus').selectpicker('render');

                if(document.querySelector('#img')){
                    document.querySelector('#img').src = objData.url_portada;
                }else{
                    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="'+objData.url_portada+'"></img>';
                }

                if(objData.portada == 'categorias.png'){
                    document.querySelector('.delPhoto').classList.add("notBlock");
                }else{
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }

                $('#modalFormCategorias').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}


function removePhoto(){
    document.querySelector('#foto').value ="";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if(document.querySelector('#img')){
        document.querySelector('#img').remove();
    }
    // Agrega la imagen predeterminada
    document.querySelector('.prevPhoto div').innerHTML = '<img id="img" src="assets/img/uploads/categorias.png">';
}

// Para abrir el modal del formulario de registro de categotias
function OpenModal() {
    document.querySelector('.tile-title').innerHTML ="Nueva Categoria";
    document.querySelector('.modal-title').innerHTML ="Registrar Categoria";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').innerHTML ="Guardar";
    document.querySelector("#formCategorias").reset();
    $('#modalFormCategorias').modal('show');
    removePhoto();
}

