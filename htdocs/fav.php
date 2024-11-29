<?php
    include_once("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    echo "<div class='fav'>
    <h1>Favoritos</h1>";
    $favoritos= "<script>document.write(localStorage.getItem('fav'));</script>";

    $favoritos= json_decode($favoritos, true);
    
    //DIV final
    echo"</div>";

?>