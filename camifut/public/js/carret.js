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

// Update cart logic
document.querySelectorAll('.btn-update').forEach(btn => {
    btn.onclick = function (e) {
        e.preventDefault();

        // Find the quantity input in the same row
        let row = this.closest('tr');
        let quantityInput = row.querySelector('.cart-qty-input');
        let quantity = quantityInput.value;

        // Get the base update URL from the href attribute
        let updateUrl = this.getAttribute('href');

        // Construct the new URL with the quantity parameter
        // The controller expects /cart/update/{id}?quantity={quantity}
        // distinct from the current href which is just /cart/update/{id}
        window.location.href = `${updateUrl}?quantity=${quantity}`;
    };
});
