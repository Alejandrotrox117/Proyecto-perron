

//funcion para superponer el editor para que los modal que tenga funcionen
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

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

// Para abrir el modal del formulario de registro de Productos
function OpenModal() {
    document.querySelector("#idProducto").value = "";
    document.querySelector('.tile-title').innerHTML ="Nuevo Producto";
    document.querySelector('.modal-title').innerHTML ="Registrar Producto";
    // document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').innerHTML ="Guardar";
    document.querySelector("#formProductos").reset();
    $('#modals_productos').modal('show');
    //removePhoto();
}
