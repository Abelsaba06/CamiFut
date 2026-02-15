let addToCartBtn = document.getElementById('add-to-cart-btn');
if (addToCartBtn) {
    addToCartBtn.onclick = function () {
        let productId = this.getAttribute('data-id');
        let quantity = document.getElementById('quantity').value;
        let patches = document.getElementById('parches-select').value;

        // Obtindre la talla seleccionada
        let size = '';
        let activeSizeBtn = document.querySelector('.size-btn.active');
        if (activeSizeBtn) {
            size = activeSizeBtn.innerText;
        } else {
            alert('Per favor, selecciona una talla.');
            return;
        }

        // Obtindre la personalització
        let personalization = '';
        let isCustom = document.querySelector('.personalitzacio-btn').classList.contains('active');
        if (isCustom) {
            let name = document.getElementById('custom-name').value;
            let number = document.getElementById('custom-number').value;
            if (name || number) {
                personalization = `${name} - ${number}`;
            }
        }

        // Construir la URL amb els paràmetres de consulta
        let url = `/cart/add/${productId}?quantity=${quantity}&size=${encodeURIComponent(size)}&personalization=${encodeURIComponent(personalization)}&patches=${encodeURIComponent(patches)}`;

        fetch(url, {
            method: 'POST'
        })
            .then(response => response.json())
    };
}

// Lògica per a actualitzar el carret
document.querySelectorAll('.btn-update').forEach(btn => {
    btn.onclick = function (e) {
        e.preventDefault();

        // Buscar l'entrada de quantitat en la mateixa fila
        let row = this.closest('tr');
        let quantityInput = row.querySelector('.cart-qty-input');
        let quantity = quantityInput.value;

        // Obtindre la URL base d'actualització des de l'atribut href
        let updateUrl = this.getAttribute('href');

        // Construir la nova URL amb el paràmetre de quantitat
        // El controlador espera /cart/update/{id}?quantity={quantity}
        // a diferència de l'href actual que és només /cart/update/{id}
        window.location.href = `${updateUrl}?quantity=${quantity}`;
    };
});
