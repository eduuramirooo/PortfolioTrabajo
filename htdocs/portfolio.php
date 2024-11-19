<?php
    $id= $_SESSION['id'];
    include_once ("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    if($conectar){
        $queryH = $conectar->recibir_datos("SELECT * FROM head WHERE id_usuario = $id limit 1");
        echo "<div class='portfolio'>";
        foreach($queryH as $row){
            echo"<div class='headA'>";
            echo "<img src='".$row['img']."' alt='".$row['name']."' width='300px'>";
            echo "<div class='infoHead'>";
            echo "<h2>".$row['name']."</h2>";
            echo "<h2>".$row['apellido']."</h2>";
            echo "<h2>".$row['apellido2']."</h2>";
            echo "<h2>".$row['anio']."</h2>";
            echo "</div></div><hr>
            <div class='bloqueBajo'>
            <div class='experiencia'>
            <p>Experiencia</p>
            </div></div>";
            
        }
        echo "</div>";
    }
  
?>