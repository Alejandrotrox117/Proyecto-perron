function addToCart(button) {
    // Obtener los datos del producto
    var productCard = button.closest('.card');
    var productimg = productCard.querySelector('img').src
    var productName = productCard.querySelector('.card-title').textContent.trim();
    var productPrice = productCard.querySelector('.price').textContent.trim();
    var productId = button.getAttribute('data-id');

    // Crear un nuevo elemento de producto
    var productElement = document.createElement('div');
    productElement.classList.add('product');
    productElement.innerHTML = `
        <div class="flex text-[black] justify-between items-center pt-6">
            <img class="w-24" src="${productimg}"/>
            <div class="product-name">${productName}</div>
            <div class="product-price text-lg text-black">${productPrice}</div>
            <button class="btn btn-circle btn-xs bg-red-500 text-white" onclick="removeFromCart(this)">x</button>
        </div>
    `;

    // Obtener el contenedor de productos en el carrito
    var productsContainer = document.querySelector('.products-container');

    // Agregar el nuevo producto antes del elemento con la clase 'text-info'
    productsContainer.insertBefore(productElement, productsContainer.querySelector('.text-info'));

    // Actualizar el contador del indicador del carrito
    updateCartIndicator();
    updateSubtotal();
}

function updateSubtotal() {
    var productElements = document.querySelectorAll('.product');
    var subtotal = 0;
    productElements.forEach(function(productElement) {
        var priceString = productElement.querySelector('.product-price').textContent;
        var price = parseFloat(priceString.replace('$', '').trim());
        subtotal += price;
    });

    // Actualizar el subtotal en el HTML
    var subtotalElement = document.querySelector('.subtotal-price');
    subtotalElement.textContent = '$' + subtotal.toFixed(2);
}

function updateCartIndicator() {
    var productElements = document.querySelectorAll('.dropdown.dropdown-end .dropdown-content .card-body .product');
    var indicator = document.querySelector('.dropdown.dropdown-end .indicator-item');
    indicator.textContent = productElements.length;
}

function removeFromCart(button) {
    // Obtener el elemento del producto
    var productElement = button.parentElement.parentElement;

    // Eliminar el elemento del producto del carrito
    productElement.remove();

    // Actualizar el contador del indicador del carrito
    updateCartIndicator();
    updateSubtotal();
}

function updateCartIndicator() {
    // Obtener todos los elementos de productos
    var productElements = document.querySelectorAll('.dropdown.dropdown-end .dropdown-content .card-body .product');

    // Obtener el contador del indicador del carrito
    var indicator = document.querySelector('.dropdown.dropdown-end .indicator-item');

    // Actualizar el contador con la cantidad de productos
    indicator.textContent = productElements.length;
}

document.addEventListener('DOMContentLoaded', function () {
    var headerSwiper = new Swiper('.header-swiper', {
        loop: true, // Permite el desplazamiento infinito
        autoplay: {
            delay: 3000, // Intervalo de tiempo entre cada slide (en milisegundos)
            disableOnInteraction: false, // Permite que el autoplay continúe incluso cuando el usuario interactúa con el carrusel
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});


