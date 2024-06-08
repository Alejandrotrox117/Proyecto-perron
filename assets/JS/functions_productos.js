


// Para abrir el modal del formulario de registro de Productos
function OpenModal() {
    document.querySelector("#idProducto").value = "";
    document.querySelector('.tile-title').innerHTML ="Nuevo Producto";
    document.querySelector('.modal-title').innerHTML ="Registrar Producto";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').innerHTML ="Guardar";
    document.querySelector("#formProductos").reset();
    $('#modals_productos').modal('show');
    //removePhoto();
}
