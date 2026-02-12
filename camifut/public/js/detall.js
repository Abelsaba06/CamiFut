document.querySelectorAll('.size-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Treu la classe active de tots
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        // Posa la classe active al clickat
   this.classList.add('active');
        // Actualitza l'input ocult
    document.getElementById('talla-seleccionada').value = this.innerText;
    });
});