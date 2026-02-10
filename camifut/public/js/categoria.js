if (document.getElementById("crearCategoria")) {
    document.getElementById("crearCategoria").click=crearCategoria
}
function crearCategoria() {
    document.getElementById("categoriaparacrear").innerHTML="<input id='categorianueva' type='text'>"
    fetch("/categoria/crear"),{
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nombre:document.getElementById("categorianueva").value}).then(response => response.json())
    }
}