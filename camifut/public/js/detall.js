// Funció per a controlar la visibilitat del formulari de personalització
function visibilitatformulari() {
    // Comprova si el botó de personalització té la classe 'active'
    if (document.querySelector('.personalitzacio-btn').classList.contains('active')) {
        // Si està actiu, mostra el formulari eliminant la classe 'hidden'
        document.querySelector('.custom-form').classList.remove('hidden');
    } else {
        // Si no està actiu, amaga el formulari afegint la classe 'hidden'
        document.querySelector('.custom-form').classList.add('hidden');
    }
}

// Comprovació inicial en carregar la pàgina
visibilitatformulari();

// Gestió dels botons de selecció de talla
document.querySelectorAll('.size-btn').forEach(btn => {
    btn.onclick = function () {
        // Elimina la classe 'active' de tots els botons de talla
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        // Afig la classe 'active' al botó que s'ha clicat
        this.classList.add('active');
    };
});

// Gestió dels botons d'opció (Personalitzat / Estàndard)
document.querySelectorAll('.option-btn').forEach(btn => {
    btn.onclick = function () {
        // Elimina la classe 'active' de tots els botons d'opció
        document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('active'));
        // Afig la classe 'active' al botó seleccionat
        this.classList.add('active');
        // Actualitza la visibilitat del formulari segons l'opció triada
        visibilitatformulari();
    };
});