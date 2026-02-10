if (document.getElementById("crearCategoria")) {
    document.getElementById("crearCategoria").onclick = mostrarCategoriacreacion
}
function mostrarCategoriacreacion() {
    document.getElementById("categoriaparacrear").innerHTML = "<input id='categorianueva' type='text'><button id=guardar>Guardar</button>"
    document.getElementById("guardar").onclick = crearCategoria
}
function crearCategoria() {
    let nombre = document.getElementById("categorianueva").value
    fetch("/categoria/crear", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nombre: nombre })
    }).then(response => response.json()).then(() => window.location.reload())
}