<?php
    $id= $_SESSION['id'];
    include_once ("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    $idPorfolio= $_SESSION['idPortfolio'];
    if($conectar){
        $queryH = $conectar->recibir_datos("SELECT * FROM head WHERE id_portfolio = $idPorfolio LIMIT 1");
        $queryE = $conectar->recibir_datos("SELECT * FROM linea_experiencia WHERE id_portfolio = $idPorfolio");
        echo "<h1>Portfolio/CV</h1>";
        echo "<div class='portfolio'>";
        foreach($queryH as $row){
            echo"<div class='headA'>";
            echo "<img src='".$row['img']."' alt='".$row['name']."'  >";
            echo "<div class='infoHead'>";
            echo "<h2>".$row['name']."</h2>";
            echo "<h2>".$row['apellido']."</h2>";
            echo "<h2>".$row['apellido2']."</h2>";
            echo "<h2>".$row['anio']."</h2>";
            echo "</div></div><hr>
            <div class='bloqueBajo'>
            <div class='experiencia'>
            <p>Experiencia</p>";
            foreach($queryE as $row){
                echo "<h3>".$row['company']."-".$row['position']."</h3>";
                echo "<h3>".$row['fechaE']." ".$row['fechaS']."</h3>";
                echo "<h3>".$row['experience']."</h3>";
            }
            echo"</div></div>";
            
        }
        echo "</div>";
    }
  
?>