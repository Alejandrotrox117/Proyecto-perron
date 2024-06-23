//datatable
let tablaProductos;

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
            { "data": "codigo" },
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

    //funcion para agregar una producto
    if(document.querySelector("#formProductos")){
        let formProductos = document.querySelector("#formProductos");
        formProductos.onsubmit = function(e){
            e.preventDefault();
            let nombre = document.querySelector('#nombre').value;
            let precio = document.querySelector('#txtprecio').value;
            let cantidad = document.querySelector('#cantidad').value;
            let modelo = document.querySelector('#modelo').value;
            let color = document.querySelector('#color').value;
            let capacidad = document.querySelector('#capacidad').value;
            if(nombre == '' || precio == '' || cantidad == ''|| modelo == ''|| color == ''|| capacidad == ''){
                swal("Atencion", "Todos los campos son obligatorios. Si observas que el productos que deseas agregar no aplica en el campo, Coloca NA", "error");
                return false;
            }
            let ajaxUrl = base_url + '/productos/setProducto';
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let formData = new FormData(formProductos);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status){
                        //$('#modals_productos').modal("hide");
                        //formProductos.reset();
                        swal("Productos", objData.msg, "success");
                        document.querySelector("#idProducto").value = objData.idProducto;
                        document.querySelector("#containerGallery").classList.remove("notblock");
                        document.querySelector('#containerGallery').style.display = 'block';  

                        tablaProductos.ajax.reload(null, false);
                    }else{
                        swal("Error", objData.msg, "error");
                    }
                 }
                 return false;
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
}
}, false);

function generarCodigoUnico(){
            let numeroAleatorio = Math.floor(Math.random() * 900000) + 100000;
            let request = new XMLHttpRequest();
            let ajaxUrl = base_url + '/Productos/getCodigo/' + numeroAleatorio;
            request.open("GET", ajaxUrl, true);
            request.onreadystatechange = function () {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        let objData = JSON.parse(request.responseText);
                        if(objData == "ok") {
                            
                            document.querySelector("#codigo").value = numeroAleatorio;
                        }
                        if(objData == "exist"){
                            generarCodigoUnico();
                        }
                    }
                }
            };
            request.send();
}

function fntInputFile() {
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(input) {
        input.addEventListener('change', function() {
            console.log("Change event captured!");
            let idProducto = document.querySelector("#idProducto").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");
            let uploadFoto = this.value;
            let fileimg = this.files;
            let prevImg = document.querySelector("#" + parentId + " .prevImage");
            let nav = window.URL || window.webkitURL;

            if (uploadFoto != '') {
                let type = fileimg[0].type;
                let name = fileimg[0].name;

                if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                    prevImg.innerHTML = "Archivo no válido";
                    this.value = "";
                    return false;
                } else {
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/assets/img/loading.svg">`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url + '/productos/setImage'; 
                    let formData = new FormData();
                    console.log(formData);
                    formData.append('idProducto', idProducto);
                    formData.append("foto", this.files[0]);

                    request.open("POST", ajaxUrl, true);
                    request.send(formData);
                    request.onreadystatechange = function() {
                        if (request.readyState != 4) return;
                        if (request.status == 200) {
                            let objData = JSON.parse(request.responseText);
                            console.log("Response from server:", objData); 
                            if (objData.status) {
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                let btnDeleteImage = document.querySelector("#" + parentId + " .btnDeleteImage");
                                btnDeleteImage.setAttribute("imgname", objData.imgname);
                                console.log("imgname set to:", objData.imgname); 
                                document.querySelector("#" + parentId + " .btnUploadfile").classList.add("notblock");
                                btnDeleteImage.classList.remove("notblock");
                            } else {
                                swal("Error", objData.msg, "error");
                            }
                        }
                    }
                }
            }
        });
    });
}

function fntDelItem(element) {
    let nameImg = document.querySelector(element + ' .btnDeleteImage').getAttribute("imgname");
    let idProducto = document.querySelector("#idProducto").value;

    console.log("Attempting to delete image:", nameImg);
    console.log("Product ID:", idProducto);

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/productos/delFile'; 

    let formData = new FormData();
    formData.append('idProducto', idProducto);
    formData.append('file', nameImg);

    console.log("FormData to be sent:", formData.get('idProducto'), formData.get('file'));

    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function() {
        if (request.readyState != 4) return;
        if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            console.log("Server response:", objData);
            if (objData.status) {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            } else {
                swal("", objData.msg, "error");
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


                document.querySelector("#celCodigo").innerHTML = objProducto.codigo;
                document.querySelector("#celNombre").innerHTML = objProducto.nombre;
                document.querySelector("#celPrecio").innerHTML = objProducto.precio;
                document.querySelector("#celcantidad").innerHTML = objProducto.cantidad;
                document.querySelector("#celModelo").innerHTML = objProducto.modelo;
                document.querySelector("#celColor").innerHTML = objProducto.color;
                document.querySelector("#celCapacidad").innerHTML = objProducto.capacidad;
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
                    document.querySelector("#idProducto").value = objProducto.productoId;
                    document.querySelector("#nombre").value = objProducto.nombre;
                    document.querySelector("#descripcion").value = objProducto.descripcion;
                    document.querySelector("#txtprecio").value = objProducto.precio;
                    document.querySelector("#cantidad").value = objProducto.cantidad;
                    document.querySelector("#codigo").value = objProducto.codigo;
                    document.querySelector("#modelo").value = objProducto.modelo;
                    document.querySelector("#color").value = objProducto.color;
                    document.querySelector("#capacidad").value = objProducto.capacidad;
                    document.querySelector("#categoria").value = objProducto.categoriaId;
                    document.querySelector("#estado").value = objProducto.estado;

                    console.log(objProducto.images);
                    if(objProducto.images.length > 0){
                        let objProductos = objProducto.images;
                        for (let p = 0; p < objProductos.length; p++) {
                            let key = Date.now()+p;
                            htmlImage +=`<div id="div${key}">
                                <div class="prevImage">
                                <img src="${objProductos[p].url_image}"></img>
                                </div>
                                <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].imagen}">
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

function btnDeleteProduct(idProducto){
    swal({
        title: "Eliminar Producto",
        text: "¿Realmente quiere eliminar el Producto?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
  
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/productos/delProducto';
            let strData = "idProducto="+idProducto;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status){
                        swal("Atención!", objData.msg , "error");
                        tablaProductos.ajax.reload(function () {
                            btnEditInfo();
                            btnDeleteProduct();
                          });
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }
  
    });
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
function OpenModalProductos() {
    generarCodigoUnico();
    document.querySelector("#idProducto").value = "";
    document.querySelector('.tile-title').innerHTML ="Nuevo Producto";
    document.querySelector('.modal-title').innerHTML ="Registrar Producto";
    // document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').innerHTML ="Guardar";
    document.querySelector("#formProductos").reset();
    document.querySelector("#containerGallery").classList.add("notblock");
    document.querySelector('#containerGallery').style.display = 'none';
    document.querySelector("#containerImages").innerHTML = "";
    $('#modals_productos').modal('show');        
    //removePhoto();
}
