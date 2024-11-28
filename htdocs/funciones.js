function cargar(atributo, tiempo){
    setTimeout(function(){
        atributo.classList.add('visible');
    }, tiempo);
}