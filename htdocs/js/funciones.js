window.onload = () => {
    const paginaActual = window.location.href;
    const form = document.querySelector(".loginForm");
    const boton = document.querySelector("#iniciarSesionButton");
    const container = document.querySelector(".container-fav");
    const portfolioA = document.querySelector(".portfolioA");
    const botonFav = document.querySelector("#añadirP");
    let urlParams = new URLSearchParams(window.location.search);
    let id = urlParams.get('portfolio');

// Check si hay algun registro en el localstorage
if (localStorage.getItem("fav") === null) {
    const favoritoDiv= document.querySelector(".fav")
    favoritoDiv.style.display = "none";
}


    // Check if the current page includes "portfolio"
    if (paginaActual.includes("portfolio")) {
        let carrito = JSON.parse(localStorage.getItem("fav")) || [];

        if (carrito.includes(id)) {
            botonFav.innerHTML = "Eliminar de favoritos";
        }

        botonFav.addEventListener("click", () => {
            if (carrito.includes(id)) {
                // Remove from favorites
                let index = carrito.indexOf(id);
                if (index !== -1) {
                    carrito.splice(index, 1);
                    localStorage.setItem("fav", JSON.stringify(carrito));
                    botonFav.innerHTML = "Añadir a favoritos";
                    botonFav.disabled = false;
                }
            } else {
                // Add to favorites
                carrito.push(id);
                localStorage.setItem("fav", JSON.stringify(carrito));
                botonFav.innerHTML = "Eliminar de favoritos";
                botonFav.disabled = true;
            }
        });
    }

    // Add to favorites function
    const añadirFav = (id) => {
        let carrito = JSON.parse(localStorage.getItem("fav")) || [];

        if (!carrito.includes(id)) {
            carrito.push(id);
            localStorage.setItem("fav", JSON.stringify(carrito));
        }
    };

    // Hide elements on specific page
    if (paginaActual === "http://localhost/index.php?id=1") {
        container.style.display = "none";
        boton.style.display = "none";
    }

    // Handle button click for login form
    boton.addEventListener("click", () => {
        form.style.right = "22%";
        boton.style.display = "none";
        container.style.display = "none";
        portfolioA.style.display = "none";
    });

    // Animate portfolio previews
    const portfolio = document.querySelectorAll('.portfolioPreview');
    for (let i = 0; i < portfolio.length; i++) {
        cargarAtributos(portfolio[i], i * 200); // Add incremental delay for each iteration
    }

    function cargarAtributos(atributo, tiempo) {
        setTimeout(() => {
            atributo.classList.add('visible');
        }, tiempo);
    }
};
