
<?php
   echo "<script>
    document.addEventListener('DOMContentLoaded', () => {
        const portfolio = document.querySelectorAll('.portfolioPreview');
        for (let i = 0; i < portfolio.length; i++) {
            cargarAtributos(portfolio[i], i * 200); // Cada iteración tiene un retraso adicional
        }
    });
    
    function cargarAtributos(atributo, tiempo) {
        setTimeout(() => {
            atributo.classList.add('visible');
        }, tiempo);
    } 
    
    function cambiarTitulo(nuevoTitulo) {
        const tituloElemento = document.getElementById('titulo'); // Cambiar el nombre de la variable
        console.log(tituloElemento);    
        if (tituloElemento) { // Verificar si el elemento existe
            tituloElemento.innerHTML = nuevoTitulo;
        }
    }
    </script>";
    include_once ("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    $id= $_SESSION['id'];
    $papelera = $_SESSION['papelera'] ?? null;
    echo "<h1 id='titulo'>Portfolios </h1>"; 
    echo "<a href='index.php?corr=3' class='btnIE' id='PR'>Papelera de reciclaje🗑️</a>";
    if($papelera==1){
        $query = $conectar->recibir_datos("SELECT * FROM port WHERE id_usuario = $id and activo = 0");
        echo "<script>const titulo=document.getElementById('titulo')
         titulo.innerHTML='Papelera de reciclaje'
         const portfolios=document.querySelector('.portfolios')
         const btnIE=document.querySelector('.btnIE')
         btnIE.style.display='none'
         </script>";
    }else if($papelera==0){
        $query = $conectar->recibir_datos("SELECT * FROM port WHERE id_usuario = $id and activo = 1");
        if(!$query){
            echo "<script>const titulo=document.getElementById('titulo')
            titulo.innerHTML='No tienes portfolios activos' 
            const btnIE=document.querySelector('.btnIE')
            </script>";
            include_once("form.php");
        }
    }
   

    if($query){
        echo "<div class='portfolios'>";
        foreach($query as $row){
            $getDatos = $conectar->recibir_datos("SELECT h.name, h.img, e.company, e.fechaE FROM head h INNER JOIN linea_experiencia e ON h.id_portfolio = e.id_portfolio WHERE h.id_portfolio = ".$row['id']."");
            if($getDatos){
                foreach($getDatos as $rows){
                   echo "<div class='portfolioPreview'><a href='index.php?portfolio=".$row['id']."' > ";
                   echo "<img src='".$rows['img']."' alt='".$rows['name']."'>
                   <div class='info'>";
                   echo "<h2>".$rows['name']."</h2>";
                       echo "<h4>".$rows['company']."-".$rows['fechaE']."</h4>";
                   echo " </div></div></a>";
               }
               
           }
        }
        echo "</div>";
    }

?>