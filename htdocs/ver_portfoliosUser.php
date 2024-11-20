<?php
    include_once ("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    $id= $_SESSION['id'];
    $query = $conectar->recibir_datos("SELECT * FROM port WHERE id_usuario = $id");
    if($query){
        $getImportante =$conectar-> recibir_datos("Select name, img FROM head WHERE id_portfolio = ".$query[0]['id']." ");
        $getExp= $conectar-> recibir_datos("Select company, fechaE from linea_experiencia WHERE id_portfolio = ".$query[0]['id']." ");
        if($getImportante && $getExp){
            echo "<h1>Portfolios</h1>";
            echo "<a class='boton' href='index.php?corr=1'>Add portfolio</a>";
            echo "<div class='portfolios'>";
            foreach($getImportante as $row){
                echo "<a href='portfolio.php?".$query[0]['id']."' > <div class='portfolioPreview'>";
                echo "<img src='".$row['img']."' alt='".$row['name']."'>";
                echo "<h2>".$row['name']."</h2>";
                echo "<h3>Experiencia</h3>";
                foreach($getExp as $row){
                    echo "<h4>".$row['company']."-".$row['fechaE']."</h4>";
                }
                echo "</div> </a>";
            }
            echo "</div>";
        }

        

    }

?>