<?php
    include_once ("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    $id= $_SESSION['id'];
    $query = $conectar->recibir_datos("SELECT * FROM port WHERE id_usuario = $id");
    if($query){
        $getDatos = $conectar->recibir_datos("SELECT h.name, h.img, e.company, e.fechaE FROM head h INNER JOIN linea_experiencia e ON h.id_portfolio = e.id_portfolio WHERE h.id_portfolio = ".$query[0]['id']."");
    
        if($getDatos){
            echo "<a class='boton' href='index.php?corr=2'>Add portfolio</a>";
            echo "<h1>Portfolios</h1>";
            echo "<div class='portfolios'>";
            foreach($getDatos as $row){
                echo "<a href='index.php?portfolio".$query[0]['id']."' > <div class='portfolioPreview'>";
                echo "<img src='".$row['img']."' alt='".$row['name']."'>";
                echo "<h2>".$row['name']."</h2>";
                
                
                    echo "<h4>".$row['company']."-".$row['fechaE']."</h4>";
                
                echo "</div> </a>";
            }
            echo "</div>";
        }

        

    }

?>