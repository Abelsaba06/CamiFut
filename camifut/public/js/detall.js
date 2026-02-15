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
