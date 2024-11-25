
<?php
    echo "<script> document.addEventListener(\"DOMContentLoaded\",()=>{
        const portfolio = document.querySelectorAll(\".portfolioPreview\");
        for(let i=0; i<portfolio.length; i++){
                setTimeout(()=>{
                portfolio[i].classList.add('visible');
            },100);
            }
          
         });
    </script>";
    include_once ("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    $id= $_SESSION['id'];
    $query = $conectar->recibir_datos("SELECT * FROM port WHERE id_usuario = $id");
    echo "<h1 id='titulo'>Portfolios</h1>"; 
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
    }else{
        echo "<script>const titulo=document.getElementById('titulo')
        titulo.innerHTML='No tienes portfolios'
        const portfolios=document.querySelector('.portfolios')
        portfolios.style.display='flex'    
        </script>";
        include_once("home.php");
    }
?>