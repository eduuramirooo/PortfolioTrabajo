window.onload = () => {
    // ONLOAD, cargo el localStorage y si el url=id es igual a 1, el boton cambia a eliminar de favoritos
    const paginaActual=window.location.href;
    const form=document.querySelector(".loginForm");
    const boton=document.querySelector("#iniciarSesionButton");
    const container=document.querySelector(".container-fav");
    const portfolioA = document.querySelector('.portfolioA');
    let urlParams = new URLSearchParams(window.location.search);
    let id = urlParams.get('portfolio');
    boton.addEventListener("click",()=>{
        form.style.right="22%";
        boton.style.display="none";
        container.style.display="none";
        portfolioA.style.display="none";º
    });
    if(paginaActual === "http://localhost/index.php?id=1"){
        container.style.display = "none";
        boton.style.display = "none";
    }
    const portfolio = document.querySelectorAll('.portfolioPreview');
        for (let i = 0; i < portfolio.length; i++) {
            cargarAtributos(portfolio[i], i * 200); // Cada iteración tiene un retraso adicional
        }
        function cargarAtributos(atributo, tiempo) {
            setTimeout(() => {
                atributo.classList.add('visible');
            }, tiempo);
        } 

        //Cargar localStorage
        const botonFav = document.querySelector('#añadirP');
        botonFav.addEventListener('click', () => {
            if(id!=null){
                localStorage.setItem("fav", id);
                botonFav.innerHTML = "Añadido a favoritos";
                botonFav.disabled = true;
            }
        });
      
}