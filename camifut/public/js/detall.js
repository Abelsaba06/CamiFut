function visibilitatformulari() {
    if (document.querySelector('.personalitzacio-btn').classList.contains('active')) {
        document.querySelector('.custom-form').classList.remove('hidden');
    } else {
        document.querySelector('.custom-form').classList.add('hidden');
    }
}

// Initial check
visibilitatformulari();

document.querySelectorAll('.size-btn').forEach(btn => {
    btn.onclick = function () {
        // Treu la classe active de tots
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        // Posa la classe active al clickat
        this.classList.add('active');
    };
});

document.querySelectorAll('.option-btn').forEach(btn => {
    btn.onclick = function () {
        // Treu la classe active de tots
        document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('active'));
        // Posa la classe active al clickat
        this.classList.add('active');
        // Update form visibility
        visibilitatformulari();
    };
});

// Add to cart logic
const addToCartBtn = document.getElementById('add-to-cart-btn');
if (addToCartBtn) {
    addToCartBtn.addEventListener('click', function () {
        const productId = this.getAttribute('data-id');
        const quantity = document.getElementById('quantity').value;
        const patches = document.getElementById('parches-select').value;

        // Get selected size
        let size = '';
        const activeSizeBtn = document.querySelector('.size-btn.active');
        if (activeSizeBtn) {
            size = activeSizeBtn.innerText;
        } else {
            alert('Por favor, selecciona una talla.');
            return;
        }

        // Get personalization
        let personalization = '';
        const isCustom = document.querySelector('.personalitzacio-btn').classList.contains('active');
        if (isCustom) {
            const name = document.getElementById('custom-name').value;
            const number = document.getElementById('custom-number').value;
            if (name || number) {
                personalization = `${name} - ${number}`;
            }
        }

        // Construct URL with query parameters
        const url = `/cart/add/${productId}?quantity=${quantity}&size=${encodeURIComponent(size)}&personalization=${encodeURIComponent(personalization)}&patches=${encodeURIComponent(patches)}`;

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
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });
    });
}
