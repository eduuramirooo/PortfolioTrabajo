window.onload = () => {
    const paginaActual = window.location.href;
    const form = document.querySelector(".loginForm");
    const boton = document.querySelector("#iniciarSesionButton");
    const container = document.querySelector(".container-fav");
    const portfolioA = document.querySelector(".portfolioA");
    const botonFav = document.querySelector("#añadirP");
    const favoritoDiv = document.querySelector(".fav");
    let urlParams = new URLSearchParams(window.location.search);
    let id = urlParams.get('portfolio');
    const gotoP= document.querySelector("#gotoP");
    const gotoPS= document.querySelector("#gotoPS");
    gotoPS.addEventListener("change", () => {
        gotoP.href = "http://localhost/index.php?portfolio="+gotoPS.value+"&&ocultar=1";
    });
    gotoP.addEventListener("click", () => {
        if(gotoPS.value!=0){

            container.style.display = "none";
        }
    });

    // Check si hay algún registro en el localStorage
    if (!localStorage.getItem("fav")) {
        if (favoritoDiv) favoritoDiv.style.display = "none";localStorage.clear();
        
    }
    // Check if the current page includes "portfolio"
    if (paginaActual.includes("portfolio") && id) {
        let carrito = JSON.parse(localStorage.getItem("fav")) || [];
        if (carrito.includes(id)) {
            botonFav.innerHTML = "Eliminar de favoritos";
        }
if (paginaActual.includes("ocultar")) {
        container.style.display = "none";
}
        botonFav.addEventListener("click", () => {
            if (carrito.includes(id)) {
                // Remove from favorites
                carrito = carrito.filter(item => item !== id);
                botonFav.innerHTML = "Añadir a favoritos";
            } else {
                // Add to favorites
                carrito.push(id);
                botonFav.innerHTML = "Eliminar de favoritos";
            }

            localStorage.setItem("fav", JSON.stringify(carrito));
            botonFav.disabled = false; // Asegura que no se deshabilite permanentemente.
        });
    }

    // Ocultar elementos en una página específica
    if (paginaActual === "http://localhost/index.php?id=1") {
        if (container) container.style.display = "none";
        if (boton) boton.style.display = "none";
    }

    // Manejar animación de las vistas previas de portfolio
    const portfolio = document.querySelectorAll('.portfolioPreview');
    portfolio.forEach((item, i) => {
        setTimeout(() => {
            item.classList.add('visible');
        }, i * 200);
    });

    // Evento de inicio de sesión
    if (boton) {
        boton.addEventListener("click", () => {
            if (form) form.style.right = "22%";
            boton.style.display = "none";
            if (container) container.style.display = "none";
            if (portfolioA) portfolioA.style.display = "none";
        });
    }
};
