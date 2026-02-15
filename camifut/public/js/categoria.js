// Si existeix l'element per a crear categoria, li assignem l'esdeveniment de clic
if (document.getElementById("crearCategoria")) {
    document.getElementById("crearCategoria").onclick = mostrarCategoriacreacion
}

// Funció per a mostrar el formulari de creació de categoria
function mostrarCategoriacreacion() {
    // Inserim un camp de text i un botó de guardar en el contenidor
    document.getElementById("categoriaparacrear").innerHTML = "<input id='categorianueva' type='text'><button id=guardar>Guardar</button>"

    // Assignem la funció de creació al nou botó de guardar
    document.getElementById("guardar").onclick = crearCategoria
}

// Funció per a enviar la nova categoria al servidor
function crearCategoria() {
    let nombre = document.getElementById("categorianueva").value

    // Realitzem la petició POST per a guardar la categoria
    fetch("/categoria/crear", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nombre: nombre })
    })
        .then(response => response.json())
        // Recarreguem la pàgina per a mostrar els canvis
        .then(window.location.reload())
}