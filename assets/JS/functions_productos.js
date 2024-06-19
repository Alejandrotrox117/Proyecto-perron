//datatable
let tablaProductos;

//funcion para superponer el editor para que los modal que tenga funcionen
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});


window.addEventListener('load', function(){

    //DataTable
    tablaProductos = $('#tablaProductos').DataTable({
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
            "url": base_url + "/productos/getProductos",
            "dataSrc": ""
        },
        "columns": [
            { "data": "productoId" },
            { "data": "nombre" },
            { "data": "cantidad" },
            { "data": "precio"},
            { "data": "estado"},
            { "data": "acciones"}
        ],
        "columnDefs":[
                        {'className': "textcenter", "targets": [2]},
                        {'className': "textright", "targets": [3]},
                        {'className': "textcenter", "targets": [4]}
                    ],
        "destroy": true,
        "responsive": true,
        "pageLength": 10,
        "order": [[0, "asc"]]
    });

    //funcion para agregar una categoria
    if(document.querySelector("#formProductos")){
        let formProductos = document.querySelector("#formProductos");
        formProductos.onsubmit = function(e){
            e.preventDefault();
            let nombre = document.querySelector('#nombre').value;
            let precio = document.querySelector('#txtprecio').value;
            let cantidad = document.querySelector('#cantidad').value;
            if(nombre == '' || precio == '' || cantidad == ''){
                swal("Atencion", "Todos los campos son obligatorios.", "error");
                return false;
            }
            tinyMCE.triggerSave(); //Funcion para tomar los datos del editor tinyMCE
            let ajaxUrl = base_url + '/productos/setProducto';
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let formData = new FormData(formProductos);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status){
                        $('#modals_productos').modal("hide");
                        formProductos.reset();
                        swal("Productos", objData.msg, "success");
                        document.querySelector("#idProducto").value = objData.idproducto;

                        tablaProductos.ajax.reload(null, false);
                    }else{
                        swal("Error", objData.msg, "error");
                    }
                 }
                 return false;
            }

        }
    }

    //Funcion para asignar un valor diferente al div del boton galeria de imagenes
    if(document.querySelector(".btnAddImage")){
        let btnAddImage =  document.querySelector(".btnAddImage");
        btnAddImage.onclick = function(e){
         let key = Date.now();
         let newElement = document.createElement("div");
         newElement.id= "div"+key;
         newElement.innerHTML = `
             <div class="prevImage"></div>
             <input type="file" name="foto" id="img${key}" class="inputUploadfile">
             <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
             <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
         document.querySelector("#containerImages").appendChild(newElement);
         document.querySelector("#div"+key+" .btnUploadfile").click();
         fntInputFile();
        }
     }
 
     fntInputFile();
     selectCategorias();
}, false);

//Funcion para el uso de la libreria de la edicion en textarea
$(document).ready(function() {
    tinymce.init({
        selector: '#descripcion',
	    width: "100%",
        height: 300,    
        statubar: true,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
    });
});

function fntInputFile(){
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function(){
            let idProducto = document.querySelector("#idProducto").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");            
            let uploadFoto = document.querySelector("#"+idFile).value;
            let fileimg = document.querySelector("#"+idFile).files;
            let prevImg = document.querySelector("#"+parentId+" .prevImage");
            let nav = window.URL || window.webkitURL;
            if(uploadFoto !=''){
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                }else{
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/assets/img/loading.svg" >`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'/productos/setImage'; 
                    let formData = new FormData();
                    formData.append('idProducto',idProducto);
                    formData.append("foto", this.files[0]);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);
                    request.onreadystatechange = function(){
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status){
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",objData.imgname);
                                document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notblock");
                                document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notblock");
                            }else{
                                swal("Error", objData.msg , "error");
                            }
                        }
                    }

                }
            }

        });
    });
}

function btnDelProduct(element){
    let nameImg = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
    let idProducto = document.querySelector("#idProducto").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/productos/delFile'; 

    let formData = new FormData();
    formData.append('idProducto',idProducto);
    formData.append("file",nameImg);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            }else{
                swal("", objData.msg , "error");
            }
        }
    }
}

function btnViewInfo(idProducto){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objProducto = objData.data;
                let estadoProducto = objProducto.estado == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';


                document.querySelector("#celNombre").innerHTML = objProducto.nombre;
                document.querySelector("#celPrecio").innerHTML = objProducto.precio;
                document.querySelector("#celcantidad").innerHTML = objProducto.cantidad;
                document.querySelector("#celCategoria").innerHTML = objProducto.categoria;
                document.querySelector("#celStatus").innerHTML = estadoProducto;
                document.querySelector("#celDescripcion").innerHTML = objProducto.descripcion;

                if(objProducto.images.length > 0){
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        htmlImage +=`<img src="${objProductos[p].url_image}"></img>`;
                    }
                }
                document.querySelector("#celFotos").innerHTML = htmlImage;
                $('#modalViewProducto').modal('show');

            }else{
                swal("Error", objData.msg , "error");
            }
        }
    } 
}

function btnEditInfo(element,idProducto){
        rowTable = element.parentNode.parentNode.parentNode;
        document.querySelector('.modal-title').innerHTML ="Actualizar Producto";
        document.querySelector('.tile-title').innerHTML ="Modifica este Producto";
        document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
        document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
        document.querySelector('#btnActionForm').innerHTML ="Actualizar";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Productos/getProducto/'+idProducto;
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    let htmlImage = "";
                    let objProducto = objData.data;
                    document.querySelector("#idProducto").value = objProducto.productosId;
                    document.querySelector("#nombre").value = objProducto.nombre;
                    document.querySelector("#descripcion").value = objProducto.descripcion;
                    document.querySelector("#txtprecio").value = objProducto.precio;
                    document.querySelector("#cantidad").value = objProducto.cantidad;
                    document.querySelector("#categoria").value = objProducto.categoriaId;
                    document.querySelector("#estado").value = objProducto.estado;
                    tinymce.activeEditor.setContent(objProducto.descripcion); 
    
                    if(objProducto.images.length > 0){
                        let objProductos = objProducto.images;
                        for (let p = 0; p < objProductos.length; p++) {
                            let key = Date.now()+p;
                            htmlImage +=`<div id="div${key}">
                                <div class="prevImage">
                                <img src="${objProductos[p].url_image}"></img>
                                </div>
                                <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}">
                                <i class="fas fa-trash-alt"></i></button></div>`;
                        }
                    }
                    document.querySelector("#containerImages").innerHTML = htmlImage; 
                    document.querySelector("#containerGallery").classList.remove("notblock");           
                    $('#modals_productos').modal('show');
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
        }
}

//Funcion que se activa cuando se necesita traer los valores de la categoria
function selectCategorias(){
    if(document.querySelector('#categoria')){
        let ajaxUrl = base_url + '/categorias/getSelectCategorias';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#categoria').innerHTML = request.responseText;
            }
        }
    }
}



// Para abrir el modal del formulario de registro de Productos
function OpenModal() {
    document.querySelector("#idProducto").value = "";
    document.querySelector('.tile-title').innerHTML ="Nuevo Producto";
    document.querySelector('.modal-title').innerHTML ="Registrar Producto";
    // document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').innerHTML ="Guardar";
    document.querySelector("#formProductos").reset();
    $('#modals_productos').modal('show');
    if(document.querySelector('.modal-title').textContent == "Registrar Producto"){
            document.querySelector('#containerGallery').style.display = 'none';
    }else{
        document.querySelector('#containerGallery').style.display = 'block';
    }
        
    //removePhoto();
}
