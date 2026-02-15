let addToCartBtn = document.getElementById('add-to-cart-btn');
if (addToCartBtn) {
    addToCartBtn.onclick = function () {
        let productId = this.getAttribute('data-id');
        let quantity = document.getElementById('quantity').value;
        let patches = document.getElementById('parches-select').value;

        // Get selected size
        let size = '';
        let activeSizeBtn = document.querySelector('.size-btn.active');
        if (activeSizeBtn) {
            size = activeSizeBtn.innerText;
        } else {
            alert('Por favor, selecciona una talla.');
            return;
        }

        // Get personalization
        let personalization = '';
        let isCustom = document.querySelector('.personalitzacio-btn').classList.contains('active');
        if (isCustom) {
            let name = document.getElementById('custom-name').value;
            let number = document.getElementById('custom-number').value;
            if (name || number) {
                personalization = `${name} - ${number}`;
            }
        }

        // Construct URL with query parameters
        let url = `/cart/add/${productId}?quantity=${quantity}&size=${encodeURIComponent(size)}&personalization=${encodeURIComponent(personalization)}&patches=${encodeURIComponent(patches)}`;

        fetch(url, {
            method: 'POST'
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Producto añadido al carrito!');
                    // Optional: Update cart counter in header if it exists
                } else {
                    alert('Error al añadir al carrito');
                }
            })
    };
}
